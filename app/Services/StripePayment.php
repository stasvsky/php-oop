<?php

declare(strict_types = 1);

namespace App\Services;

class StripePayment implements PaymentGatewayInterface
{
    public function charge(array $customer, float $amount, float $tax): bool
    {
        echo 'Charging From Stripe <br />';

        // sleep(1);

        return (bool) mt_rand(0, 1);
    }
}
