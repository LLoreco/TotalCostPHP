<?php
    class Item{
        private $baseCost;
        private $quantity;

        public function __construct($baseCost, $quantity )
        {
            $this->$baseCost = $baseCost;
            $this->$quantity = $quantity;
        }

        private function getTotalBasePrice(){
            return $this->baseCost * $this->quantity;
        }
    }
?>