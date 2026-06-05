<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KategoriRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('kategori') ? $this->route('kategori')->id : null;
        return [
            'nama_kategori' => ['required', 'string', 'max:100', 'unique:kategori_layanan,nama_kategori,' . $id],
            'deskripsi' => ['nullable', 'string', 'max:500'],
            'is_active' => ['required', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.unique' => 'Nama kategori sudah digunakan.',
            'nama_kategori.max' => 'Nama kategori maksimal 100 karakter.',
            'deskripsi.max' => 'Deskripsi maksimal 500 karakter.',
        ];
    }
}
