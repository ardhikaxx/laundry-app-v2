<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $judul ?? 'Laporan Cuciin' }}</title>
    <style>
        @page { margin: 30px; }
        body { 
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; 
            font-size: 11px; 
            color: #1e293b; /* slate-800 */
            line-height: 1.6; 
            margin: 0;
            padding: 0;
        }
        
        /* Header */
        .header { 
            width: 100%; 
            margin-bottom: 30px; 
            display: table; 
            border-bottom: 1px solid #e2e8f0; /* slate-200 */
            padding-bottom: 20px;
        }
        .header-left { display: table-cell; width: 60%; vertical-align: middle; }
        .header-right { display: table-cell; width: 40%; text-align: right; vertical-align: middle; }
        
        .brand-logo { 
            background-color: #4f46e5; /* indigo-600 */
            color: #ffffff;
            width: 35px;
            height: 35px;
            text-align: center;
            line-height: 35px;
            font-size: 20px;
            font-weight: bold;
            display: inline-block;
            border-radius: 8px;
            margin-right: 10px;
        }
        .brand-name { 
            font-size: 24px; 
            font-weight: 900; 
            color: #0f172a; /* slate-900 */
            margin: 0; 
            letter-spacing: -1px;
            display: inline-block;
            vertical-align: middle;
        }
        .brand-name span { color: #4f46e5; }
        .tagline { font-size: 9px; color: #64748b; margin: 2px 0 0 0; text-transform: uppercase; letter-spacing: 1px; font-weight: bold; }
        
        .meta-info { font-size: 9px; color: #94a3b8; }
        .meta-info strong { color: #475569; }
        
        /* Title */
        .title-container { margin-bottom: 30px; }
        .document-type { 
            font-size: 10px; 
            font-weight: 900; 
            color: #4f46e5; 
            text-transform: uppercase; 
            letter-spacing: 2px; 
            margin-bottom: 5px;
        }
        .document-id { 
            font-size: 20px; 
            font-weight: 900; 
            color: #0f172a; 
            margin: 0;
            letter-spacing: -0.5px;
        }
        
        /* Table Design */
        .table { width: 100%; border-collapse: collapse; margin-bottom: 25px; }
        .table th { 
            background-color: #f8fafc; /* slate-50 */
            color: #64748b; /* slate-500 */
            font-weight: bold; 
            text-align: left; 
            text-transform: uppercase; 
            font-size: 9px; 
            padding: 12px 15px;
            border-bottom: 2px solid #e2e8f0;
        }
        .table td { 
            padding: 12px 15px; 
            border-bottom: 1px solid #f1f5f9; 
            vertical-align: middle; 
        }
        .table tr:last-child td { border-bottom: none; }
        
        /* Summary / Footer Table */
        .summary-table { width: 40%; margin-left: 60%; margin-top: 20px; }
        .summary-row { display: table; width: 100%; padding: 5px 0; }
        .summary-label { display: table-cell; text-align: left; color: #64748b; font-weight: bold; }
        .summary-value { display: table-cell; text-align: right; font-weight: 900; color: #0f172a; font-size: 12px; }
        .total-row { 
            border-top: 2px solid #e2e8f0; 
            margin-top: 10px; 
            padding-top: 10px;
            background-color: #f1f5f9;
            padding: 15px;
            border-radius: 10px;
        }
        .total-label { color: #0f172a; font-size: 11px; }
        .total-value { color: #4f46e5; font-size: 18px; }
        
        /* Utilities */
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .text-indigo { color: #4f46e5; }
        .font-black { font-weight: 900; }
        .rounded-card { background-color: #f8fafc; padding: 15px; border-radius: 15px; border: 1px solid #e2e8f0; }
        
        .badge { 
            display: inline-block; 
            padding: 4px 8px; 
            font-size: 8px; 
            font-weight: 900; 
            text-align: center; 
            border-radius: 6px; 
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .badge-indigo { background-color: #e0e7ff; color: #4338ca; }
        .badge-emerald { background-color: #d1fae5; color: #047857; }
        .badge-amber { background-color: #fef3c7; color: #b45309; }
        .badge-rose { background-color: #ffe4e6; color: #be123c; }
        .badge-slate { background-color: #f1f5f9; color: #475569; }

        /* Footer Info */
        .footer-note { 
            margin-top: 50px; 
            padding-top: 20px; 
            border-top: 1px dashed #e2e8f0;
            text-align: center; 
            font-size: 9px; 
            color: #94a3b8;
        }
        
        .page-footer {
            position: fixed;
            bottom: -10px;
            left: 0;
            right: 0;
            font-size: 8px;
            color: #cbd5e1;
            text-align: center;
        }
        .pagenum:before { content: counter(page); }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-left">
            <div class="brand-logo">C</div>
            <h1 class="brand-name">Cuci<span>in</span></h1>
            <p class="tagline">Premium Laundry Experience</p>
        </div>
        <div class="header-right meta-info">
            <strong>Dicetak:</strong> {{ now()->format('d M Y, H:i') }}<br>
            <strong>Operator:</strong> {{ auth()->check() ? auth()->user()->name : 'System' }}
        </div>
    </div>

    <div class="content">
        @yield('pdf-content')
    </div>

    <div class="footer-note">
        Dokumen ini dihasilkan secara otomatis oleh Sistem Manajemen <strong>Cuciin</strong>.<br>
        Terima kasih atas kerja sama dan kepercayaan Anda.
    </div>

    <div class="page-footer">
        Halaman <span class="pagenum"></span> — Cuciin Management System
    </div>
</body>
</html>
