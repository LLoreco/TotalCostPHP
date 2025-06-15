<?php
    namespace App\Models;
    use DateTime;

    class Customer{
        private $dateBirth;
        private $sex;

        private $ageForMen = 63;
        private $ageForWom = 58;

        public function __construct(string $birthdDate, string $sex)
        {
            $this->dateBirth = new DateTime($birthdDate);
            $this->sex = strtoupper($sex);
        }

        public function checkRightForDiscount(): bool
        {
            $currentDate = new DateTime();
            $age = $currentDate->diff($this->dateBirth)->y;
            if($this->sex === 'M' && $age >= $this->ageForMen || $this->sex === 'F' && $age >= $this->ageForWom){
                return true;
            }
            else{
                return false;
            }
        }
    }
?>