<?php
    namespace App\Services;
    class Validator {
        public static function validateRequest(array $data): array {
            $errors = [];

            if (!isset($data['customer']) || !is_array($data['customer'])) {
                $errors[] = 'Customer data is required';
            } else {
                if (empty($data['customer']['dateBirth']) || !self::isValidDate($data['customer']['dateBirth'])) {
                    $errors[] = 'Valid customer birth date is required';
                }
                if (empty($data['customer']['sex']) || !in_array(strtoupper($data['customer']['sex']), ['M', 'F'])) {
                    $errors[] = 'Valid customer gender (M or F) is required';
                }
            }

            if (empty($data['deliveryDateTime']) || !self::isValidDate($data['deliveryDateTime'])) {
                $errors[] = 'Valid delivery date and time is required';
            }

            if (empty($data['items']) || !is_array($data['items'])) {
                $errors[] = 'Items array is required';
            } else {
                foreach ($data['items'] as $index => $item) {
                    if (!isset($item['baseCost']) || !is_numeric($item['baseCost']) || $item['baseCost'] <= 0) {
                        $errors[] = "Item $index: Valid base price is required";
                    }
                    if (!isset($item['quantity']) || !is_int($item['quantity']) || $item['quantity'] <= 0) {
                        $errors[] = "Item $index: Valid quantity is required";
                    }
                }
            }

            return $errors;
        }

        private static function isValidDate(string $date): bool {
            try {
                new \DateTime($date);
                return true;
            } catch (\Exception $e) {
                return false;
            }
        }
    }
?>