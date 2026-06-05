<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateCategoryRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }
    protected function prepareForValidation(): void {
        $input = $this->all();

        array_walk_recursive($input, function (&$val) {
            if (is_string($val)) {
                $val = trim(strip_tags($val));
            }
        });
        $this->merge($input);
    }
    public function rules(): array{
        return [
            'name' => 'required|string|max:255|unique:categories,name,' . $this->route('id'),
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.string'   => 'Nama kategori harus berupa teks.',
            'name.max'      => 'Nama kategori maksimal berisi 255 karakter.',
            'name.unique'   => 'Nama kategori sudah ada.',
        ];
    }

    /**
     * Mengembalikan respon JSON jika validasi gagal (Khusus API).
     */
    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(
            response()->json([
                'status'  => 'error',
                'data'    => null,
                'message' => $validator->errors()->first()
            ], 422)
        );
    }
}