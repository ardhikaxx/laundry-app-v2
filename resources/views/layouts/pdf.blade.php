<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $judul ?? 'Laporan Cuciin' }}</title>
    <style>
        @page { margin: 40px; }
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 12px; color: #333; line-height: 1.5; }
        
        /* Header */
        .pdf-header { width: 100%; border-bottom: 2px solid #0d6efd; padding-bottom: 15px; margin-bottom: 20px; display: table; }
        .header-left { display: table-cell; width: 60%; vertical-align: middle; }
        .header-right { display: table-cell; width: 40%; text-align: right; vertical-align: middle; font-size: 10px; color: #666; }
        
        .toko-nama { font-size: 24px; font-weight: bold; color: #0d6efd; margin: 0; letter-spacing: 1px; }
        .toko-tagline { font-size: 10px; color: #777; margin: 2px 0 0 0; }
        
        /* Title */
        .pdf-title-container { text-align: center; margin-bottom: 20px; }
        .pdf-title { font-size: 16px; font-weight: bold; display: inline-block; padding: 8px 20px; background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 4px; text-transform: uppercase; letter-spacing: 1px; }
        
        /* Typography */
        h1, h2, h3, h4, h5, h6 { margin-top: 0; margin-bottom: 10px; font-weight: bold; }
        p { margin: 0 0 10px 0; }
        
        /* Tables */
        .table { width: 100%; border-collapse: collapse; margin-bottom: 20px; font-size: 11px; }
        .table th, .table td { padding: 8px 10px; border: 1px solid #dee2e6; vertical-align: middle; }
        .table thead th { background-color: #0d6efd; color: #ffffff; font-weight: bold; text-align: left; text-transform: uppercase; font-size: 10px; letter-spacing: 0.5px; border-color: #0d6efd; }
        .table tbody tr:nth-child(even) { background-color: #f8f9fa; }
        .table tfoot th, .table tfoot td { font-weight: bold; background-color: #f1f5f9; border-top: 2px solid #0d6efd; }
        
        /* Utilities */
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .text-left { text-align: left; }
        .fw-bold { font-weight: bold; }
        .text-muted { color: #6c757d; }
        .text-primary { color: #0d6efd; }
        .text-success { color: #198754; }
        .text-danger { color: #dc3545; }
        .bg-light { background-color: #f8f9fa; }
        
        /* Badges */
        .badge { display: inline-block; padding: 3px 6px; font-size: 9px; font-weight: bold; text-align: center; white-space: nowrap; vertical-align: baseline; border-radius: 3px; color: #fff; }
        .badge-success { background-color: #198754; }
        .badge-primary { background-color: #0d6efd; }
        .badge-danger { background-color: #dc3545; }
        .badge-warning { background-color: #ffc107; color: #000; }
        .badge-info { background-color: #0dcaf0; color: #000; }
        .badge-secondary { background-color: #6c757d; }

        /* Footer */
        .pdf-footer { position: fixed; bottom: -20px; left: 0; right: 0; width: 100%; border-top: 1px solid #dee2e6; padding-top: 10px; font-size: 9px; color: #888; display: table; }
        .footer-left { display: table-cell; width: 70%; }
        .footer-right { display: table-cell; width: 30%; text-align: right; }
        
        /* Page number pseudo-element for dompdf */
        .pagenum:before { content: counter(page); }
    </style>
</head>
<body>
    <div class="pdf-header">
        <div class="header-left">
            <h1 class="toko-nama">Cuciin</h1>
            <p class="toko-tagline">Solusi Cerdas Pakaian Bersih, Wangi, dan Rapi</p>
        </div>
        <div class="header-right">
            <strong>Tanggal Cetak:</strong> {{ now()->format('d F Y, H:i') }}<br>
            <strong>Dicetak Oleh:</strong> {{ auth()->check() ? auth()->user()->name : 'Sistem' }}
        </div>
    </div>

    <div class="pdf-content">
        @yield('pdf-content')
    </div>

    <div class="pdf-footer">
        <div class="footer-left">
            &copy; {{ date('Y') }} Cuciin Management System. All rights reserved.
        </div>
        <div class="footer-right">
            Halaman <span class="pagenum"></span>
        </div>
    </div>
</body>
</html>