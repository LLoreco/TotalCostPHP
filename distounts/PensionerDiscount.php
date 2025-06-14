<?php
    class PensionerDiscount implements DiscountBase{
        private $customer;

        public function __construct(Customer $customer )
        {
            $this->customer = $customer;
        }

        public function apply(float $amount): float
        {
            if($this->customer->checkRightForDiscount()){
                #Скидка 5%
                return $amount * 0.05;
            }
            return 0;
        }
    }
?>