<?php

namespace App\Http\Requests;

use App\Helpers\HandleJsonResponseHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreRentRequest extends FormRequest
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
            'no_pelanggan' => 'required|exists:customers,number',
            'kode_buku' => 'required|exists:books,code',
            "tanggal_sewa" => "required|date",
            "tanggal_pengembalian" => "required|date",
            "total" => "required|numeric",
            "denda" => "required|numeric"
        ];
    }

    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $errors = $validator->errors();

        throw new HttpResponseException(HandleJsonResponseHelper::res("Error Validation", $errors, 422, false));
    }
}
