<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return response()->json($users);
    }

    public function getUsersByRole($roleName)
    {
        $users = User::whereJsonContains('roles', $roleName)->get();
    return response()->json($users);
    }

    public function uploadProfileImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
            'user_id' => 'required|string',
        ]);

        $imagePath = $request->file('image')->getRealPath();
        $imageFile = file_get_contents($imagePath);
        $base64Image = base64_encode($imageFile);

        $user = User::where('user_id', $request->user_id)->first();
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $user->Profile_Photo = $base64Image;
        $user->save();

        return response()->json(['message' => 'Image uploaded successfully'], 200);
    }

    public function getProfileImage($userId)
{
    $user = User::where('user_id', $userId)->first();

    if (!$user) {
        return response()->json(['error' => 'User not found'], 404);
    }

    $base64Image = $user->Profile_Photo;
    if (!$base64Image) {
        return response()->json(['error' => 'No profile image found'], 404);
    }

    return response()->json(['image' => $base64Image], 200);
}


    /**
 * Register a new user.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'user_id' => 'required|string|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->user_id,
        'password' => bcrypt($request->password),
        'roles' => $request->input('roles')
    ]);

    $token = $user->createToken('auth-token')->plainTextToken;

    return response()->json([
        'access_token' => $token,
        'token_type' => 'Bearer',
        'user' => $user
    ], 201);
}

public function uploadCsv(Request $request)
{
    $validator = Validator::make($request->all(), [
        'file' => 'required|mimes:csv,txt',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 400);
    }

    $file = $request->file('file');
    $csvData = array_map('str_getcsv', file($file->getRealPath()));

    try {
        foreach ($csvData as $row) {
            User::create([
                'user_id' => $row[0],
                'name' => $row[1],
                'password' => bcrypt('user'), // the default password is 'user'
                'business_unit' => $row[2],
                'roles' => ["User"], // set the 'roles' attribute to ["User"]
                // add more columns as needed
            ]);
        }
    } catch (QueryException $e) {
        return response()->json(['error' => 'Database error: ' . $e->getMessage()], 500);
    }

    return response()->json(['message' => 'CSV data imported successfully'], 200);
}
public function login(Request $request)
{
    $credentials = $request->only('user_id', 'password');

    if (Auth::attempt($credentials)) {
        $token = Auth::user()->createToken('API Token')->plainTextToken;

        return response()->json([
            'token' => $token,
        ]);
    }

    return response()->json([
        'message' => 'Invalid credentials',
    ], 401);
}


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json($user);
    }

    public function getUserByUserId($userId)
{
    $user = User::where('user_id', $userId)->first();
    return response()->json($user);
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(null, 204);
    }
}
