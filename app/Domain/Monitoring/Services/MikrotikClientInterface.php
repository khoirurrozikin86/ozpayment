<?php

namespace App\Domain\Monitoring\Services;

interface MikrotikClientInterface
{
    /** buka koneksi sekali, lalu jalankan callback dengan koneksi itu */
    public function withConnection(array $conf, \Closure $callback, $default = null);
    /** hasil ping ringkas */
    public function pingOne($mikrotik, string $target, int $count = 1, int $timeoutMs = 1000): array;
}
