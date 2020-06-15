<?php

namespace App\Http\Requests\Admin\Question;

use Illuminate\Validation\Rule;
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
            'lesson_id' => 'required|sometimes|exists:lessons,id',
            'title' => 'required|sometimes',
            'content' => 'required|sometimes',
            'type' => [
                'required',
                'sometimes',
                Rule::in(array_keys(config('data.questions_types'))),
            ],
            'image' => 'nullable|image',
        ];
    }
}
