<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Resources\ErrorResource;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    protected function failedValidation(Validator $validator){
        $response = (new ErrorResource($validator->errors()))->response()->setStatusCode(422);
        throw (new ValidationException($validator, $response));
    }
}
