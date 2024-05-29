<?php

declare(strict_types=1);

use App\Entity\Invoice;
use App\Entity\InvoiceItem;
use App\Enums\InvoiceStatus;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Dotenv\Dotenv;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$params = [
    'host'     => $_ENV['DB_HOST'],
    'user'     => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASS'],
    'dbname'   => $_ENV['DB_DATABASE'],
    'driver'   => $_ENV['DB_DRIVER'] ?? 'pdo_mysql',
];

$entityManager = new EntityManager(
    DriverManager::getConnection($params),
    ORMSetup::createAttributeMetadataConfiguration([
        __DIR__ . '/Entity',
    ])
);

$items = [['Item 1', 1, 15], ['Item 2', 2, 7.5], ['Item 3', 4, 3.75]];

// $invoice = (new Invoice())
//     ->setAmount(45)
//     ->setInvoiceNumber('1')
//     ->setStatus(InvoiceStatus::Pending)
//     ->setCreatedAt(new DateTime());
//
// foreach ($items as [$description, $quantity, $unitPrice]) {
//     $item = (new InvoiceItem())
//         ->setDescription($description)
//         ->setQuantity($quantity)
//         ->setUnitPrice($unitPrice);
//
//     $invoice->addItem($item);
//     // $entityManager->persist($item);
// }
//
// $entityManager->persist($invoice);
// $entityManager->flush();

// $entityManager->remove($invoice);
// $entityManager->flush();

// echo $entityManager->getUnitOfWork()->size();


// $invoice = $entityManager->find(Invoice::class, 10);
// $invoice->setStatus(InvoiceStatus::Paid);
// $entityManager->flush();


$invoice = $entityManager->find(Invoice::class, 11);
$invoice->setStatus(InvoiceStatus::Paid);
$invoice->getItems()->get(0)->setDescription('Foo Bar');
$entityManager->flush();
