<?php

namespace App\Domain\Pembayarans\Services;

use App\Domain\Pembayarans\DTOs\PaymentData;
use App\Domain\Pembayarans\Actions\{CreatePaymentAction, DeletePaymentAction};
use App\Models\Pembayaran;

class PaymentService
{
    public function __construct(
        protected CreatePaymentAction $create,
        protected DeletePaymentAction $delete,
    ) {}

    public function create(array $payload): Pembayaran
    {
        return ($this->create)(PaymentData::fromArray($payload));
    }

    public function delete(Pembayaran $payment): void
    {
        ($this->delete)($payment);
    }
}
