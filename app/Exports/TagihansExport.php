<?php

namespace App\Exports;

use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\{FromQuery, WithHeadings, WithMapping, ShouldAutoSize};

class TagihansExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    public function __construct(protected Builder $query) {}

    public function query()
    {
        return $this->query->clone();
    }

    public function headings(): array
    {
        return ['No Tagihan', 'Bulan', 'Tahun', 'ID Pelanggan', 'Nama Pelanggan', 'Jumlah', 'Status', 'Tgl Bayar', 'Updated At'];
    }

    public function map($r): array
    {
        return [
            $r->no_tagihan,
            $r->nama_bulan,      // dari join
            $r->tahun,
            $r->id_pelanggan,
            $r->nama_pelanggan,  // dari join
            (float)$r->jumlah_tagihan,
            $r->status,
            optional($r->tgl_bayar)->format('Y-m-d'),
            optional($r->updated_at)->format('Y-m-d H:i:s'),
        ];
    }
}
