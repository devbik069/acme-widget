<?php

require_once __DIR__.'/src/Basket.php';
require_once './vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// Example usage:
$catalogue = [
    'R01' => 32.95,
    'G01' => 24.95,
    'B01' => 7.95,
];

$deliveryCharges = [
    50 => 4.95,
    90 => 2.95,
    PHP_INT_MAX => 0.00,
];

$offers = [
    'R01' => 'buy_one_get_second_half_price',
];

$logger = new Logger("acme-basket");
$stream_handler = new StreamHandler('log/app.log', Logger::DEBUG);
$logger->pushHandler($stream_handler);

$basket1 = new Basket($catalogue, $deliveryCharges, $offers);
$basket1->add('B01');
$basket1->add('G01');

echo "Products: ". json_encode($basket1->getProducts());
echo "<br>";
echo "Basket Total: $". $basket1->total();
$logger->info(json_encode($basket1->getProducts())." Basket Total: $". $basket1->total());

echo "<br>";
echo "<br>";
$basket2 = new Basket($catalogue, $deliveryCharges, $offers);
$basket2->add('R01');
$basket2->add('R01');

echo "Products: ". json_encode($basket2->getProducts());
echo "<br>";
echo "Basket Total: $". $basket2->total();
$logger->info(json_encode($basket2->getProducts())." Basket Total: $". $basket2->total());

echo "<br>";
echo "<br>";
$basket3 = new Basket($catalogue, $deliveryCharges, $offers);
$basket3->add('R01');
$basket3->add('G01');

echo "Products: ". json_encode($basket3->getProducts());
echo "<br>";
echo "Basket Total: $". $basket3->total();
$logger->info(json_encode($basket3->getProducts())." Basket Total: $". $basket3->total());

echo "<br>";
echo "<br>";
$basket4 = new Basket($catalogue, $deliveryCharges, $offers);
$basket4->add('B01');
$basket4->add('B01');
$basket4->add('R01');
$basket4->add('R01');
$basket4->add('R01');


echo "Products: ". json_encode($basket4->getProducts());
echo "<br>";
echo "Basket Total: $". $basket4->total();
$logger->info(json_encode($basket4->getProducts())." Basket Total: $". $basket4->total());
