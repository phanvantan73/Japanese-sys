<?php

namespace App\Http\Requests\Research;

use App\Http\Requests\BaseApiRequest;

class IndexRequest extends BaseApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'keyword' => 'required',
        ];
    }
}
