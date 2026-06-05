<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LayananRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'kategori_layanan_id' => ['required', 'exists:kategori_layanan,id'],
            'nama_layanan'        => ['required', 'string', 'max:150'],
            'satuan'              => ['required', 'in:kg,pcs,item'],
            'harga'               => ['required', 'numeric', 'min:0'],
            'estimasi_hari'       => ['required', 'integer', 'min:1', 'max:30'],
            'deskripsi'           => ['nullable', 'string', 'max:1000'],
            'is_active'           => ['required', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama_layanan.required'        => 'Nama layanan wajib diisi.',
            'nama_layanan.max'             => 'Nama layanan maksimal 150 karakter.',
            'kategori_layanan_id.required' => 'Kategori layanan wajib dipilih.',
            'kategori_layanan_id.exists'   => 'Kategori layanan tidak ditemukan.',
            'satuan.required'              => 'Satuan wajib dipilih.',
            'satuan.in'                    => 'Satuan tidak valid.',
            'harga.required'               => 'Harga wajib diisi.',
            'harga.numeric'                => 'Harga harus berupa angka.',
            'harga.min'                    => 'Harga tidak boleh negatif.',
            'estimasi_hari.required'       => 'Estimasi hari wajib diisi.',
            'estimasi_hari.min'            => 'Estimasi minimal 1 hari.',
            'estimasi_hari.max'            => 'Estimasi maksimal 30 hari.',
        ];
    }
}
