<?php
    interface DiscountStrategy {
        public function apply(float $amount): float;
    }
?>