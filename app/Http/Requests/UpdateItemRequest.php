<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateItemRequest extends FormRequest{
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
    public function rules(): array
    {
        // Mengabaikan ID item saat ini agar tidak mentok aturan unique
        return [
            'name'        => 'required|string|max:255|unique:items,name,' . $this->route('id'),
            'quantity'    => 'required|integer|min:0',
            'price'       => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'        => 'Nama item wajib diisi.',
            'name.string'          => 'Nama item harus berupa teks.',
            'name.max'             => 'Nama item maksimal berisi 255 karakter.',
            'name.unique'          => 'Nama item sudah terdaftar.',
            'quantity.required'    => 'Jumlah item wajib diisi.',
            'quantity.integer'     => 'Jumlah harus angka bulat.',
            'quantity.min'         => 'Jumlah tidak boleh negatif.',
            'price.required'       => 'Harga item wajib diisi.',
            'price.numeric'        => 'Harga harus berupa angka.',
            'price.min'            => 'Harga tidak boleh negatif.',
            'category_id.required' => 'Kategori wajib dipilih.',
            'category_id.exists'   => 'Kategori tidak ditemukan.',
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