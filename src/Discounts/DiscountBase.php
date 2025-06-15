<?php
    namespace App\Discounts;
    
    interface DiscountBase {
        public function apply(float $amount): float;
    }
?>