<?php

// command
// receiver
// invoker / requester

interface ICommand {
    function execute();
}

// receiver
class Television {
    public function turnOn() {
        echo 'Television: turn on';
    }

    public function turnOff() {
        echo 'Television: turn off';
    }
}

class PowerOnCommand implements ICommand {
    private $tv;
    public function __construct(Television $tv) {
        $this->tv = $tv;
    }

    public function execute() {
        $this->tv->turnOn();
    }
}

class PowerOffCommand implements ICommand {
    private $tv;
    public function __construct(Television $tv) {
        $this->tv = $tv;
    }

    public function execute() {
        $this->tv->turnOff();
    }
}

// invoker / requester
class RemoteControl {
    private $command;

    public function setCommand(ICommand $command) {
        $this->command = $command;
    }

    public function pressButton() {
        $this->command->execute();
    }
}

$tv = new Television();
$remote = new RemoteControl();

$powerOnCommand = new PowerOnCommand($tv);
$powerOffCommand = new PowerOffCommand($tv);

$remote->setCommand($powerOnCommand);
$remote->pressButton();

$remote->setCommand($powerOffCommand);
$remote->pressButton();
