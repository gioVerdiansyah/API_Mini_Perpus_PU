<?php

namespace App\Http\Requests;

use App\Helpers\HandleJsonResponseHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "email" => "required|email:rcf,dns",
            "password" => "required"
        ];
    }
    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $errors = $validator->errors()->toArray();
        $messages = [];
        $i = 0;
        foreach ($errors as $field => $errorMessages) {
            $formattedMessages = [];
            foreach ($errorMessages as $errorMessage) {
                $i++;
                $formattedMessages[] = $i . ". {$errorMessage}";
            }
            $messages[] = implode(', ', $formattedMessages);
        }

        throw new HttpResponseException(HandleJsonResponseHelper::res("Error Validation", "Validasi Error: " . implode(', ', $messages), 422, false));
    }
}
