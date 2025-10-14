<?php

namespace App\Domain\Pembayarans\Actions;

use App\Models\Pembayaran;
use Illuminate\Support\Facades\DB;

class DeletePaymentAction
{
    public function __invoke(Pembayaran $payment): void
    {
        DB::transaction(function () use ($payment) {
            $tagihan = $payment->tagihan()->lockForUpdate()->first();
            $payment->delete();

            // Re-evaluate status tagihan setelah penghapusan
            if ($tagihan) {
                $sum = (float)$tagihan->pembayarans()->sum('amount');
                if ($sum + 0.00001 >= (float)$tagihan->jumlah_tagihan) {
                    $tagihan->update(['status' => 'lunas', 'tgl_bayar' => $tagihan->tgl_bayar ?? now()->toDateString()]);
                } else {
                    $tagihan->update(['status' => 'belum']); // belum lunas lagi
                }
            }
        });
    }
}
