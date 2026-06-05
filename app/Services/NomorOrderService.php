<?php
namespace App\Services;

use Illuminate\Support\Facades\DB;

class NomorOrderService
{
    /**
     * Generate kode: PREFIX-YYYY-NNNNN
     * Contoh: ORD-2025-00001
     */
    public static function generate(string $prefix, string $table, string $column, int $pad = 5): string
    {
        $tahun = now()->year;
        $like  = "{$prefix}-{$tahun}-%";
        $last  = DB::table($table)
                   ->where($column, 'like', $like)
                   ->orderByDesc($column)
                   ->value($column);

        $seq = $last
            ? ((int) substr($last, strrpos($last, '-') + 1)) + 1
            : 1;

        return "{$prefix}-{$tahun}-" . str_pad($seq, $pad, '0', STR_PAD_LEFT);
    }
}
