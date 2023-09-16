<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\API\V1\Auth\LoginRequest;
use App\Http\Requests\API\V1\Auth\RegisterRequest;
use App\Http\Resources\API\V1\User\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController
{
    /**
     * Get current user.
     *
     * @return UserResource
     */
    public function me(): UserResource
    {
        return new UserResource(Auth::user());
    }

    /**
     * Logs in.
     *
     * @param LoginRequest $request
     * @return UserResource
     * @throws ValidationException
     */
    public function login(LoginRequest $request): UserResource
    {
        $request->authenticate();
        $request->session()->regenerate();

        return new UserResource(Auth::user());
    }

    /**
     * Register new user.
     *
     * @param RegisterRequest $request
     * @return UserResource
     */
    public function register(RegisterRequest $request): UserResource
    {
        return new UserResource(User::create($request->validated()));
    }
}
