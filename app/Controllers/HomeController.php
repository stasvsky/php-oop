<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Container;
use App\Services\InvoiceService;
use App\View;

class HomeController
{
    public function __construct(private InvoiceService $invoiceService)
    {
    }

    public function index(): View
    {
        // $email = 'jane22@doe.com';
        // $name = 'Jane22 Doe22';
        // $amount = 1200;
        //
        // $userModel    = new User();
        // $invoiceModel = new Invoice();
        // $invoiceId    = (new SignUp($userModel, $invoiceModel))->register(
        //     [
        //         'email' => $email,
        //         'name' => $name,
        //     ],
        //     [
        //         'amount' => $amount
        //     ]
        // );

        // return View::make('index', ['invoice' => $invoiceModel->find($invoiceId)]);


        $this->invoiceService->process([], 25);

        return View::make('index');
    }
}