<?php

namespace App\Http\Requests\Admin\Course;

use App\Http\Requests\BaseAdminRequest;

class UpdateRequest extends BaseAdminRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|sometimes',
            'image' => 'nullable|image',
        ];
    }
}
