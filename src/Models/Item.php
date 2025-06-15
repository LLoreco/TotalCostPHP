<?php
    namespace App\Models;
    class Item{
        private $baseCost;
        private $quantity;

        public function __construct(float $baseCost, int $quantity )
        {
            $this->baseCost = $baseCost;
            $this->quantity = $quantity;
        }

        public function getTotalBasePrice(){
            return $this->baseCost * $this->quantity;
        }

        public function getQuantity(): int {
        return $this->quantity;
        }
    }
?>