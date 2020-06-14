<?php

namespace App\Http\Requests;

use Log;
use Auth;
use App\Exceptions\ApiException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

abstract class BaseApiRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    abstract public function rules();

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        $messages = !empty($errors) ? $errors : __('validation.missing_field');

        if (config('app.env') === 'local') {
            Log::error($messages);
        }

        throw new ApiException('error', null, $messages);
    }
}
