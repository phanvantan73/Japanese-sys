<?php

namespace App\Http\Controllers\Api\V1;

use Auth;
use Config;
use Cookie;
use Exception;
use Illuminate\Http\Request;
use App\Exceptions\ApiException;
use App\Services\Api\AuthService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(LoginRequest $request)
    {
        try {
            $inputs = $request->all();
            $passportConfig = Config::get('services.passport');
            $passportConfig['grant_type'] = Config::get('services.passport.password_grant_type');

            if (Auth::attempt(array_merge($inputs, ['deleted_at' => null]))) {
                $result = $this->authService->createAccessToken($inputs, $passportConfig);
                $token = $this->authService->getToken($result->access_token);
            } else {
                throw new ApiException('login_failed');
            }

            return response()->json([
                'data' => [
                    'status' => true,
                    'message' => __('login_successful'),
                    'access_token' => $result->access_token,
                ],
            ]);
        } catch (Exception $e) {
            report($e);
            throw new ApiException('login_failed');
        }
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'data' => [
                'status' => true,
                'message' => __('logout_successful'),
            ],
        ]);
    }

    public function register(RegisterRequest $request)
    {
        $this->authService->register($request->all());

        return response()->json([
            'data' => [
                'status' => true,
                'message' => __('register_successful'),
            ],
        ]);
    }
}
