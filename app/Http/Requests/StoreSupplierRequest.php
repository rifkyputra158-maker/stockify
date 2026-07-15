<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSupplierRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'phone' => 'nullable|regex:/^[0-9+\-\s]+$/|max:20',
        ];
    }
    public function messages(): array
    {
        return [
           'phone.regex' => 'Nomor telepon hanya boleh berisi angka.',
               ];
    }
}