<?php
    namespace App\Discounts;
    use DateTime;

    class EarlyOrderDiscount implements DiscountBase{
        private $orderDate;
        private $deliveryDate;

        public function __construct(DateTime $orderDate, DateTime $deliveryDate)
        {
            $this->orderDate = $orderDate;
            $this->deliveryDate = $deliveryDate;
        }

        public function apply(float $amount): float
        {
            $interval = $this->orderDate->diff($this->deliveryDate);
            if($interval->days >= 7 && $interval->invert === 0){
                #Скидка 4%
                return $amount * 0.04;
            }
            return 0;
        }
    }
?>
