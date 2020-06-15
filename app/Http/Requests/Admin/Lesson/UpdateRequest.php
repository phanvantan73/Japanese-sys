<?php

namespace App\Http\Requests\Admin\Lesson;

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
            'course_id' => 'required|sometimes|exists:courses,id',
            'name' => 'required|sometimes',
            'content' => 'required|sometimes',
            'image' => 'nullable|image',
        ];
    }
}
