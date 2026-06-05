<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest{

    public function authorize(): bool{
        return true;
    }
    protected function prepareForValidation(): void{
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
            'name' => 'required|string|max:255|unique:categories,name',
        ];
    }

    public function messages(): array {
        return [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.string'   => 'Nama kategori harus berupa teks.',
            'name.max'      => 'Nama kategori maksimal berisi 255 karakter.',
            'name.unique'   => 'Nama kategori sudah ada.',
        ];
    }
}