<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseApiRequest;

class LoginRequest extends BaseApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|max:255',
            'password' => 'required|max:45',
        ];
    }
}
