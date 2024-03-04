<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\Auth\UserAuthRequest;
use App\Http\Requests\Auth\UserRegisterRequest;
use App\Http\Resources\Auth\UserAuthResource;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    /**
     * function register user
     * 
     * @param UserRegisterRequest $request
     * 
     * @return JsonResponse
     */
    public function register(UserRegisterRequest $request)
    {
        $user = User::create($request->validated());

        return new UserAuthResource($user);
    }

   /**
    * function login user
    *
    * @param UserAuthRequest $request
    */
    public function login(UserAuthRequest $request) {

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        
        return new UserAuthResource($user);
    }

     /**
     * logout function
     * 
     */
    public function destory(Request $request) 
    {
       $user = $request->user();

       $user->tokens()->delete();

       return response()->noContent();
    }
}
