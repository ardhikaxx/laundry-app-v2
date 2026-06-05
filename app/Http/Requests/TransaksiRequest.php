<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransaksiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'pelanggan_id'       => ['required', 'exists:pelanggan,id'],
            'pegawai_id'         => ['nullable', 'exists:pegawai,id'],
            'tanggal_masuk'      => ['required', 'date'],
            'catatan'            => ['nullable', 'string', 'max:1000'],
            'items'              => ['required', 'array', 'min:1'],
            'items.*.layanan_id' => ['required', 'exists:layanan,id'],
            'items.*.qty'        => ['required', 'numeric', 'min:0.1'],
            'metode_bayar'       => ['required', 'in:tunai,transfer,qris,dompet_digital'],
        ];
    }

    public function messages(): array
    {
        return [
            'pelanggan_id.required'       => 'Pelanggan wajib dipilih.',
            'tanggal_masuk.required'      => 'Tanggal masuk wajib diisi.',
            'items.required'              => 'Minimal pilih 1 layanan.',
            'items.*.layanan_id.required' => 'Layanan wajib dipilih.',
            'items.*.qty.required'        => 'Kuantitas wajib diisi.',
            'items.*.qty.min'             => 'Kuantitas minimal 0.1.',
            'metode_bayar.required'       => 'Metode pembayaran wajib dipilih.',
        ];
    }
}
