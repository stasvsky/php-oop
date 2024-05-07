<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Invoice;
use App\Models\SignUp;
use App\Models\User;
use App\View;

class HomeController
{
    public function index(): View
    {
        $email = 'jane22@doe.com';
        $name = 'Jane22 Doe22';
        $amount = 1200;

        $userModel    = new User();
        $invoiceModel = new Invoice();
        $invoiceId    = (new SignUp($userModel, $invoiceModel))->register(
            [
                'email' => $email,
                'name' => $name,
            ],
            [
                'amount' => $amount
            ]
        );

        return View::make('index', ['invoice' => $invoiceModel->find($invoiceId)]);
    }
}