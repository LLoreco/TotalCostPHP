<?php


class QuantityDiscount implements DiscountBase {
    private $items;

    public function __construct(array $items) {
        $this->items = $items;
    }

    public function apply(float $amount): float {
        $totalQuantity = array_sum(array_map(fn($item) => $item->quantity, $this->items));
        if ($totalQuantity > 10) {
            #Скидка 3%
            return $amount * 0.03;
        }
        return 0;
    }
}
?>