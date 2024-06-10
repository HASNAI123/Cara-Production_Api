<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */


    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'user_id' => 'required|unique:users,user_id',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'name' => $request->input('name'),
            'user_id' => $request->input('user_id'),
            'password' => Hash::make($request->input('password')),
            'business_unit' => $request->input('business_unit'),
        ]);

        if ($request->has('roles')) {
            $user->assignRole($request->input('roles'));
        }

        return response()->json([
            'name' => $user->name,
            'user_id' => $user->user_id,
            'roles' => $user->getRoleNames()
        ], 201);
    }


    public function user_update(Request $request)
    {
        $user = User::where('user_id', $request->user_id)->first();

        if (!$user) {
            return response()->json([
                'msg' => 'User not found',
            ], 404);
        }

        $updateData = [
            'name' => $request->input('name'),
            'user_id' => $request->input('user_id'),
            'business_unit' => $request->input('business_unit'),
            'roles' => $request->input('roles'),
            'email_address' => $request->input('email_address'),// Handle nullable email_address
        ];

        // Check if Checklist_permission is provided in the request
        if ($request->has('Checklist_permission')) {
            $updateData['Checklist_permission'] = $request->input('Checklist_permission');
        }

        // Check if password is provided in the request
        if ($request->has('password')) {
            // Hash and update the password if provided
            $updateData['password'] = Hash::make($request->input('password'));
        }

        // Update the user's data
        $user->update($updateData);

        // Retrieve the updated user data
        $data = User::where('user_id', $request->input('user_id'))->get();

        return response()->json([
            'msg' => 'Successfully Updated',
            'data' => $data
        ], 201);
    }
}
