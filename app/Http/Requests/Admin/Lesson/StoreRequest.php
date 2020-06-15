<?php

namespace App\Http\Requests\Admin\Lesson;

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
            'course_id' => 'required|exists:courses,id',
            'name' => 'required',
            'content' => 'required',
            'image' => 'nullable|image',
        ];
    }
}
