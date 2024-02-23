<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\Auth\UserAuthRequest;
use App\Http\Resources\Auth\UserAuthResource;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
   /**
    * function login user
    *
    * @param UserAuthRequest $request
    */
    public function login(UserAuthRequest $request) {
        // $request->validate();

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        
        return new UserAuthResource($user);
    }
}
