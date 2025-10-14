<?php

namespace App\Domain\Tagihans\Queries;

use App\Models\Tagihan;
use Illuminate\Database\Eloquent\Builder;

class TagihanTableQuery
{
    public function builder(): Builder
    {
        return Tagihan::query()
            ->leftJoin('pelanggans', 'pelanggans.id_pelanggan', '=', 'tagihans.id_pelanggan')
            ->leftJoin('bulans', 'bulans.id_bulan', '=', 'tagihans.id_bulan')
            ->select([
                'tagihans.id',
                'tagihans.no_tagihan',
                'tagihans.id_bulan',
                'bulans.bulan as nama_bulan',
                'tagihans.tahun',
                'tagihans.id_pelanggan',
                'pelanggans.nama as nama_pelanggan',
                'tagihans.jumlah_tagihan',
                'tagihans.status',
                'tagihans.tgl_bayar',
                'tagihans.remark1',
                'tagihans.remark2',
                'tagihans.remark3',
                'tagihans.updated_at',
                'tagihans.created_at'
            ]);
    }

    public function applyFilters($q, array $f)
    {
        return $q->when(($f['only_unpaid'] ?? null) === '1', fn($qq) => $qq->where('tagihans.status', 'belum'));
    }
}
