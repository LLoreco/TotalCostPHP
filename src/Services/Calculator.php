<?php
    namespace App\Services;
    class Calculator{
        private $allDiscounts;

        public function __construct(array $discounts)
        {
            $this->allDiscounts = $discounts;
        }

        public function calculateTotalPrice(array $items, float $total) : float{
            $totalPrice = $total;
            foreach ($this->allDiscounts as $discounts){
                $discount = $discounts->apply($totalPrice);
                $totalPrice -= $discount;
            }
            return round($totalPrice,2);
        }
    }
?>