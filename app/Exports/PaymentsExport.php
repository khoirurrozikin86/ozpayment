<?php

namespace App\Exports;

use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\{FromQuery, WithHeadings, WithMapping, ShouldAutoSize};

class PaymentsExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    public function __construct(protected Builder $query) {}
    public function query()
    {
        return $this->query->clone();
    }

    public function headings(): array
    {
        return ['ID', 'Paid At', 'Amount', 'No Tagihan', 'ID Pelanggan', 'Nama Pelanggan', 'Method', 'Ref No', 'User'];
    }

    public function map($r): array
    {
        return [
            $r->id,
            optional($r->paid_at)->format('Y-m-d'),
            (float)$r->amount,
            $r->no_tagihan,
            $r->id_pelanggan,
            $r->nama_pelanggan,
            $r->method,
            $r->ref_no,
            $r->user_name,
        ];
    }
}
