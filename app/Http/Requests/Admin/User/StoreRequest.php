<?php

namespace App\Http\Requests\Admin\User;

use App\Http\Requests\BaseAdminRequest;

class StoreRequest extends BaseAdminRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'birthday' => 'nullable|date_format:Y-m-d',
            'address' => 'max:255',
            'avatar' => 'nullable|image',
        ];
    }
}
