<?php

namespace App\Services\Admin;

use Auth;

/**
 * Service class for authentication handling
 */
class AuthService extends BaseService
{
    public function login(array $inputs)
    {
        $remember = isset($inputs['remember']) && $inputs['remember'] ? true : false;

        return Auth::attempt(['email' => $inputs['email'], 'password' => $inputs['password']], $remember);
    }
}
