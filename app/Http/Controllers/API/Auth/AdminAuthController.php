<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Http\Requests\Auth\AdminAuthRequest;
use App\Http\Resources\Auth\AdminAuthResource;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    /**
     * login function
     * 
     * @param AdminAuthRequest $request
     * 
     */
    public function login(AdminAuthRequest $request)
    {   
        $admin = Admin::where('email', $request->email)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return new AdminAuthResource($admin);
    }

}
