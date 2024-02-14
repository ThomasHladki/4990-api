<?php

namespace App\Http\Controllers;

use App\Http\Requests\IdRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\EducationalInstitution;
use App\Traits\HttpResponses;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Doctor;
use App\Models\Student;

class AuthController extends Controller
{
    use HttpResponses;

    public function login(LoginRequest $request)
    {
        $request->validated($request->all());

        if(!Auth::attempt($request->only(['email', 'password']))) {
            return $this->error('', 'Invalid credentials', 400);
        }

        $user = User::query()
            ->where('email', '=', $request->email)
            ->first();
        

        return $this->success([
            'user' => $user,
            'token' => $user->createToken('Token of ' . $user->name)->plainTextToken
        ]);
    }

    public function register(RegisterUserRequest $request)      //Be sure to send password_confirmation in request  
    {
        $request->validated($request->all());

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return $this->success([
            'user' => $user,
            'token' => $user->createToken('Token of ' . $user->name)->plainTextToken
        ]);
    }

    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();

        return $this->success([
            'message' => 'You have succesfully logged out'
        ]);
    }

    public function retrieveProfileFromUser()
    {
        $user = Auth::user(); // Get the authenticated user based on the token

        if ($user->doctor()->exists()) {
            return $this->success(['doctor' => $user->doctor]);
        } elseif ($user->student()->exists()) {
            return $this->success(['student' => $user->student]);
        }

        return $this->success(['message' => 'No profile associated with user']);
    }

    public function test()
    {
        return $this->success(['message' => 'API OK']);
    }

    public function test2()
    {
        $resp = EducationalInstitution::query()
            ->get();
        return $this->success([
            '$response' => $resp
        ]);
    }

}


