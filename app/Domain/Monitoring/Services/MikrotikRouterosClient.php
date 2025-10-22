<?php

namespace App\Domain\Monitoring\Services;

use App\Services\RouterosAPI;
use Throwable;

class MikrotikRouterosClient implements MikrotikClientInterface
{
    public function __construct(private readonly RouterosAPI $api) {}

    public function withConnection(array $conf, \Closure $callback, $default = null)
    {
        try {
            $this->api->port    = $conf['port'] ?? 8728;
            $this->api->ssl     = $conf['ssl']  ?? false;
            $this->api->timeout = 5;
            $this->api->attempts = 2;
            $this->api->delay   = 1;

            if (! $this->api->connect($conf['host'], $conf['user'], $conf['pass'])) {
                return $default;
            }
            return $callback($this->api);
        } catch (Throwable $e) {
            report($e);
            return $default;
        } finally {
            $this->api->disconnect();
        }
    }

    public function pingOne($mikrotik, string $target, int $count = 2, int $timeoutMs = 1000): array
    {
        // gunakan /tool/ping + format waktu yg benar
        $rows = $mikrotik->comm('/tool/ping', [
            'address'  => $target,
            'count'    => max(1, $count),
            'interval' => '1s',
            'timeout'  => $timeoutMs . 'ms',
            // 'src-address' => '192.168.xx.yy', // aktifkan bila perlu
        ]);

        $ok = false;
        $lat = null;
        $receivedSum = null;

        foreach ((array)$rows as $r) {
            // baris reply punya 'time', summary terakhir punya 'received'/'sent'
            if (isset($r['time'])) {
                $ok = true;
                $t = (float)str_replace(['ms', ' '], '', (string)$r['time']);
                $lat = is_null($lat) ? $t : min($lat, $t); // ambil latency terbaik
            }
            if (isset($r['received'])) {
                $receivedSum = (int)$r['received'];
            }
        }

        if (!is_null($receivedSum)) {
            $ok = $receivedSum > 0;
        }

        return ['ok' => $ok, 'latency' => $lat];
    }
}
