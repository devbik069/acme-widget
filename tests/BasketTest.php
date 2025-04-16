<?php

use PHPUnit\Framework\TestCase;

class BasketTest extends TestCase
{
    private $catalogue;
    private $deliveryCharges;
    private $offers;
    private $basket;

    protected function setUp(): void
    {
        $this->catalogue = [
            'R01' => 32.95,
            'G01' => 24.95,
            'B01' => 7.95,
        ];

        $this->deliveryCharges = [
            50 => 4.95,
            90 => 2.95,
            PHP_INT_MAX => 0.00,
        ];

        $this->offers = [
            'R01' => 'buy_one_get_second_half_price',
        ];

        $this->basket = new Basket($this->catalogue, $this->deliveryCharges, $this->offers);
    }

    public function testCartExample1()
    {
        $this->basket->add('B01');
        $this->basket->add('G01');
        $this->assertEquals('37.85', $this->basket->total());
    }

    public function testCartExample2()
    {
        $this->basket->add('R01');
        $this->basket->add('R01');
        $this->assertEquals('54.37', $this->basket->total());
    }

    public function testCartExample3()
    {
        $this->basket->add('R01');
        $this->basket->add('G01');
        $this->assertEquals('60.85', $this->basket->total());
    }

    public function testCartExample4()
    {
        $this->basket->add('B01');
        $this->basket->add('B01');
        $this->basket->add('R01');
        $this->basket->add('R01');
        $this->basket->add('R01');
        $this->assertEquals('98.27', $this->basket->total());
    }

    public function testSingleProductWithoutOffer()
    {
        $this->basket->add('G01');
        $this->assertEquals('29.90', $this->basket->total());
    }

    public function testSingleProductWithOffer()
    {
        $this->basket->add('R01');
        $this->basket->add('R01');
        $this->assertEquals('54.37', $this->basket->total());
    }

    public function testMultipleProductsWithOffer()
    {
        $this->basket->add('R01');
        $this->basket->add('G01');
        $this->basket->add('B01');
        $this->basket->add('R01');
        $this->assertEquals('85.27', $this->basket->total());
    }

    public function testMultipleProductsWithoutOffer()
    {
        $this->basket->add('G01');
        $this->basket->add('B01');
        $this->assertEquals('37.85', $this->basket->total());
    }

    public function testOrderWithFreeDelivery()
    {
        $this->basket->add('R01');
        $this->basket->add('R01');
        $this->basket->add('R01');
        $this->basket->add('G01');
        $this->assertEquals('107.32', $this->basket->total());
    }

    public function testOrderWithDeliveryChargeTier1()
    {
        $this->basket->add('G01');
        $this->basket->add('B01');
        $this->basket->add('B01');
        $this->assertEquals('45.80', $this->basket->total());
    }

    public function testOrderWithDeliveryChargeTier2()
    {
        $this->basket->add('R01');
        $this->basket->add('G01');
        $this->assertEquals('60.85', $this->basket->total());
    }

    public function testEmptyBasket()
    {
        $this->assertEquals('0.00', $this->basket->total());
    }

    public function testInvalidProductCode()
    {
        $this->expectException(Exception::class);
        $this->basket->add('INVALID_CODE');
    }
}
