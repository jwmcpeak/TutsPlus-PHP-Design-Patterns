<?php

// observable
// observer

interface IShoppingCartObserver {
    function itemAdded(int $id);
}

class ShoppingCart {

    private $observers = array();
    public function attach(IShoppingCartObserver $observer) {
        $this->observers[] = $observer;
    }

    public function addItem(int $id) {
        // have the code adding item
        $this->notify($id);
    }

    private function notify(int $id) {
        foreach ($this->observers as $observer) {
            $observer->itemAdded($id);
        }
    }
}

class ShoppingCartLog implements IShoppingCartObserver {
    public function itemAdded(int $id) {
        echo "Logged item $id\n";
    }
}

$cart = new ShoppingCart();
$logger = new ShoppingCartLog();

$cart->attach($logger);

$cart->addItem(1);
$cart->addItem(5);
$cart->addItem(2745);
