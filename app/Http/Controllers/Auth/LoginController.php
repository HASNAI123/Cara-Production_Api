<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;
use App\Models\User;
use App\Models\LoginHistory;
use Illuminate\Support\Str; // Add this line


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        $credentials = $request->only('user_id', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = Str::random(60); // Generate a random token
            $user->api_token = hash('sha256', $token); // Hash the token and store it in the database
            $user->save();

            $name = $user->name;
            $role = $user->role;
            $userId = $user->user_id; // Retrieve the user_id
            $id = $user->id; // Retrieve the id
            $business_unit = $user->business_unit;
            $Last_login = $user->Last_login;

            // Update last_login timestamp
            $user->update(['Last_login' => now()]);

             // Record login history
             LoginHistory::create([
                'user_id' => $user->user_id,
                'user_name' => $user->name,
                'logged_in_at' => now(),
            ]);

            $user->refresh();

            return response()->json([
                'user' => $user,
                'access_token' => $token,
            ], 200);
        }
    }

        public function getLatestLogins()
        {
            // Retrieve the 5 latest login users
            $latestLogins = User::orderBy('last_login', 'desc')
                ->limit(5)
                ->get();

            return response()->json($latestLogins);
        }

        public function getMonthlyLogins()
{
    $monthlyLogins = [];
    for ($i = 1; $i <= 12; $i++) {
        $count = User::whereYear('last_login', date('Y'))
            ->whereMonth('last_login', $i)
            ->count();
        $monthlyLogins[date('F', mktime(0, 0, 0, $i, 10))] = $count;
    }

    return response()->json($monthlyLogins);
}
    /**
     * Log the user out (Invalidate the token).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Successfully logged out'], 200);
    }



    public function refresh(Request $request)
    {
        $request->user()->token()->delete();

        $token = $request->user()->createToken('authToken')->accessToken;

        return response()->json(['token' => $token], 200);
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'user_name' => 'required',
            'business_unit' => 'required',
            'feedback' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Create a new Feedback instance and save the data
        $feedback = new Feedback([
            'user_id' => $request->user_id,
            'user_name' => $request->user_name,
            'business_unit' => $request->business_unit,
            'feedback' => $request->feedback,
        ]);

        $feedback->save();

        return response()->json(['message' => 'Feedback saved successfully'], 201);
    }

    public function getOnlineUsersCount()
    {
        $onlineUsersCount = PersonalAccessToken::where('last_used_at', '>', now()->subMinutes(5))->count();
        return $onlineUsersCount;
    }
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
   /*  public function __construct()
    {
        $this->middleware('guest')->except('logout');
    } */
}
