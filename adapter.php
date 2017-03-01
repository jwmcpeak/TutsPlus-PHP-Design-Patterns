<?php

interface IPaymentAdapter {
    function pay($amount);
}

class FooPay {
    public function pay($amount) {
        echo "FooPay: $amount";
    }
}

class BarPayments {
    public function releaseFunds($amount) {
        echo "BarPayments: $amount";
    }
}

class FooPayAdapter implements IPaymentAdapter {
    private $fooPay;
    public function __construct(FooPay $fooPay) {
        $this->fooPay = $fooPay;
    }

    public function pay($amount) {
        $this->fooPay->pay($amount);
    }
}

class BarPaymentsAdapter implements IPaymentAdapter {
    private $barPayments;
    public function __construct(BarPayments $barPayments) {
        $this->barPayments = $barPayments;
    }

    public function pay($amount) {
        $this->barPayments->releaseFunds($amount);
    }
}

$gateway = new FooPayAdapter(new FooPay());
$gateway->pay(100);

$gateway = new BarPaymentsAdapter(new BarPayments());
$gateway->pay(200);

$user->paymentPRovider->pay(100);