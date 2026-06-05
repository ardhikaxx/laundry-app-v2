<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $data = $this->getFilteredData($request);
        return view('admin.laporan.index', compact('data'));
    }

    public function cetak(Request $request)
    {
        $data = $this->getFilteredData($request);
        return view('pdf.laporan', compact('data', 'request'))->with('is_print', true);
    }

    public function exportPdf(Request $request)
    {
        $data = $this->getFilteredData($request);
        $pdf  = Pdf::loadView('pdf.laporan', compact('data', 'request'))
                    ->setPaper('a4', 'landscape');
        return $pdf->stream('laporan-' . now()->format('Ymd') . '.pdf');
    }

    private function getFilteredData(Request $request)
    {
        $query = Transaksi::with('pelanggan');

        if ($request->dari_tanggal) {
            $query->whereDate('tanggal_masuk', '>=', $request->dari_tanggal);
        }
        if ($request->sampai_tanggal) {
            $query->whereDate('tanggal_masuk', '<=', $request->sampai_tanggal);
        }
        if ($request->status) {
            $query->where('status', $request->status);
        }
        if ($request->metode_bayar) {
            $query->where('metode_bayar', $request->metode_bayar);
        }

        return $query->latest()->get();
    }
}
