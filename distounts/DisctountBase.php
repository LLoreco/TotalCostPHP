<?php
    interface DiscountBase {
        public function apply(float $amount): float;
    }
?>