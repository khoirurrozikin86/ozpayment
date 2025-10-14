<?php

namespace App\Domain\Pembayarans\Actions;

use App\Domain\Pembayarans\DTOs\PaymentData;
use App\Models\Pembayaran;
use App\Models\Tagihan;
use Illuminate\Support\Facades\DB;

class CreatePaymentAction
{
    public function __invoke(PaymentData $data): Pembayaran
    {
        return DB::transaction(function () use ($data) {
            $pay = Pembayaran::create($data->toArray());

            // update status tagihan jika lunas
            /** @var Tagihan $tagihan */
            $tagihan = Tagihan::lockForUpdate()->findOrFail($data->tagihan_id);
            $sum = (float)$tagihan->pembayarans()->sum('amount');
            if ($sum + 0.00001 >= (float)$tagihan->jumlah_tagihan) {
                $tagihan->update([
                    'status' => 'lunas',
                    'tgl_bayar' => $tagihan->tgl_bayar ?: $data->paid_at, // set jika belum ada
                ]);
            } else {
                // tetap 'belum' untuk parsial
                if ($tagihan->status !== 'belum') {
                    $tagihan->update(['status' => 'belum']);
                }
            }

            return $pay;
        });
    }
}
