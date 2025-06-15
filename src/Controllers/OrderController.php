<?php
    namespace App\Controllers;
    use App\Services\Validator;
    use App\Models\Customer;
    use App\Models\Item;
    use App\Discounts\PensionerDiscount;
    use App\Discounts\EarlyOrderDiscount;
    use App\Discounts\QuantityDiscount;
    use App\Services\Calculator;
    use DateTime;

    class OrderController {
        public static function calculateOrder(): void {
            $input = json_decode(file_get_contents('php://input'), true);
            if (!$input) {
                http_response_code(400);
                echo json_encode(['error' => 'Invalid JSON']);
                return;
            }

            $errors = Validator::validateRequest($input);
            if (!empty($errors)) {
                http_response_code(400);
                echo json_encode(['errors' => $errors]);
                return;
            }

            try {
                $customer = new Customer($input['customer']['dateBirth'], $input['customer']['sex']);
                $orderDate = new DateTime();
                $deliveryDate = new DateTime($input['deliveryDateTime']);
                $items = array_map(fn($item) => new Item($item['baseCost'], $item['quantity']), $input['items']);
                $initialTotal = array_sum(array_map(fn($item) => $item->getTotalBasePrice(), $items));

                $discounts= [
                    new PensionerDiscount($customer),
                    new EarlyOrderDiscount($orderDate, $deliveryDate),
                    new QuantityDiscount($items),
                ];

                $calculator = new Calculator($discounts);
                $total = $calculator->calculateTotalPrice($items, $initialTotal);

                http_response_code(200);
                echo json_encode(['total' => $total]);
            } catch (\Exception $e) {
                http_response_code(500);
                echo json_encode(['error' => 'Internal server error']);
            }
        }
    }
?>