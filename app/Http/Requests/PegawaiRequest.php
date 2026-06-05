<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PegawaiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_pegawai'  => ['required', 'string', 'max:150'],
            'jabatan'       => ['required', 'string', 'max:100'],
            'no_telepon'    => ['nullable', 'string', 'max:20'],
            'alamat'        => ['nullable', 'string', 'max:500'],
            'tanggal_masuk' => ['required', 'date', 'before_or_equal:today'],
            'is_active'     => ['required', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama_pegawai.required'  => 'Nama pegawai wajib diisi.',
            'jabatan.required'       => 'Jabatan wajib diisi.',
            'tanggal_masuk.required' => 'Tanggal masuk wajib diisi.',
            'tanggal_masuk.before_or_equal' => 'Tanggal masuk tidak boleh lebih dari hari ini.',
        ];
    }
}
