<?php

// checking the inventory
// user pays
// ship the item

class Inventory {
    public function checkInventory(string $itemId) {
        echo "Checking the inventory for item: $itemId\n";

        return true;
    }
}

class PaymentGateway {
    public function pay(float $amount) {
        echo "Paying for item with $amount\n";

        return true;
    }
}

class ShippingService {
    public function shipItem(string $itemId) {
        echo "Shipping item: $itemId";
    }
}

// facade
class Order {
    private $inventory;
    private $payments;
    private $shipping;

    public function __construct() {
        $this->inventory = new Inventory();
        $this->payments = new PaymentGateway();
        $this->shipping = new ShippingService();
    }

    public function placeOrder(string $itemId, float $amount) {
        if ($this->inventory->checkInventory($itemId) && 
            $this->payments->pay($amount)) {
                $this->shipping->shipItem($itemId);
            }
    }
}

$order = new Order();
$order->placeOrder('S234951', 150);