<?php

namespace App\Domain\Pelanggans\Queries;

use App\Models\Pelanggan;
use Illuminate\Database\Eloquent\Builder;

class PelangganTableQuery
{
    public function builder(): Builder
    {
        return Pelanggan::query()
            ->leftJoin('pakets', 'pakets.id', '=', 'pelanggans.id_paket')
            ->leftJoin('servers', 'servers.id', '=', 'pelanggans.id_server')
            ->select([
                'pelanggans.id',
                'pelanggans.id_pelanggan',
                'pelanggans.nama',
                'pelanggans.no_hp',
                'pelanggans.email',
                'pelanggans.id_paket',
                'pakets.nama as paket_nama',
                'pelanggans.id_server',
                'servers.ip as server_ip',
                'pelanggans.ip_router',
                'pelanggans.ip_parent_router',
                'pelanggans.remark1',
                'pelanggans.remark2',
                'pelanggans.remark3',
                'pelanggans.updated_at',
                'pelanggans.created_at',
            ]);
    }
}
