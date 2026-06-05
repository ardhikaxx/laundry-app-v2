<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PelangganRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('pelanggan') ? $this->route('pelanggan')->id : null;
        return [
            'nama_pelanggan' => ['required', 'string', 'max:150'],
            'jenis_kelamin'  => ['required', 'in:L,P'],
            'no_telepon'     => ['required', 'string', 'max:20', 'unique:pelanggan,no_telepon,' . $id],
            'email'          => ['nullable', 'email', 'max:100', 'unique:pelanggan,email,' . $id],
            'alamat'         => ['required', 'string', 'max:500'],
            'tanggal_daftar' => ['required', 'date', 'before_or_equal:today'],
            'catatan'        => ['nullable', 'string', 'max:1000'],
            'is_active'      => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama_pelanggan.required' => 'Nama pelanggan wajib diisi.',
            'jenis_kelamin.required'  => 'Jenis kelamin wajib dipilih.',
            'no_telepon.required'     => 'No telepon wajib diisi.',
            'no_telepon.unique'       => 'No telepon sudah terdaftar.',
            'email.unique'            => 'Email sudah terdaftar.',
            'alamat.required'         => 'Alamat wajib diisi.',
            'tanggal_daftar.required' => 'Tanggal daftar wajib diisi.',
            'tanggal_daftar.before_or_equal' => 'Tanggal daftar tidak boleh lebih dari hari ini.',
        ];
    }
}
