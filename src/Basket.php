<?php

declare(strict_types=1);

class Basket
{
    private $catalogue;
    private $deliveryCharges;
    private $offers;
    private $items = [];

    public function __construct(array $catalogue, array $deliveryCharges, array $offers = [])
    {
        $this->catalogue = $catalogue;
        $this->deliveryCharges = $deliveryCharges;
        $this->offers = $offers;
    }

    public function add(string $productCode): void
    {
        if (!isset($this->catalogue[$productCode])) {
            throw new Exception("Product code {$productCode} not found in catalogue.");
        }
        $this->items[] = $productCode;
    }

    public function getProducts(): array
    {
        return $this->items;
    }

    public function total(): string
    {
        $total = 0.00;
        $productCounts = array_count_values($this->items);

        foreach ($productCounts as $productCode => $quantity) {
            $price = $this->catalogue[$productCode];
            if (isset($this->offers[$productCode])) {
                $total += $this->applyOffer($productCode, $quantity, $price);
            } else {
                $total += $quantity * $price;
            }
        }

        if (!empty($this->items)) {
            $total = $this->applyDeliveryCharges($total);
        }
        return number_format(floor($total * 100) / 100, 2);
    }

    private function applyOffer(string $productCode, int $quantity, float $price): float
    {
        $total = 0.00;
        switch ($this->offers[$productCode]) {
            case 'buy_one_get_second_half_price':
                // For the "Buy one get second half price" offer
                $pairs = intdiv($quantity, 2);
                $remainder = $quantity % 2;
                $total = $pairs * $price * 1.5 + $remainder * $price;
                break;
            default:
                throw new Exception("Offer {$this->offers[$productCode]} not implemented.");
        }

        return floor($total * 100) / 100;
    }

    private function applyDeliveryCharges(float $total): float
    {
        ksort($this->deliveryCharges);
        foreach ($this->deliveryCharges as $threshold => $charge) {
            if ($total < $threshold) {
                return $total + $charge;
            }
        }
        return $total;
    }
}
