<?php

abstract class EmployeeAbstract {
    protected $firstName;
    protected $lastName;
    protected $position;

    protected $underlings = array();

    public function __construct(string $firstName, string $lastName, string $position) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->position = $position;
    }

    public function getName() {
        return "$this->firstName $this->lastName, $this->position";
    }

    public function underlings() {
        return $this->underlings;
    }

    abstract public function addUnderling(EmployeeAbstract $underling);
}

class Executive extends EmployeeAbstract {
    public function addUnderling(EmployeeAbstract $underling) {
        $this->underlings[] = $underling;
    }
}

class Manager extends EmployeeAbstract {
    public function addUnderling(EmployeeAbstract $underling) {
        $this->underlings[] = $underling;
    }
}

class Employee extends EmployeeAbstract {
    public function addUnderling(EmployeeAbstract $underling) {
        return false;
    }
}

$ceo = new Executive('John', 'Doe', 'CEO');
$controller = new Manager('Jane', 'Doe', 'Controller');
$itManager = new Manager('Jon', 'Jacobs', 'IT Manager');
$itWorker = new Employee('Tim', 'Tifford', 'IT Grunt');

$ceo->addUnderling($itManager);
$ceo->addUnderling($controller);

$itManager->addUnderling($itWorker);

function echoEmployees(EmployeeAbstract $employee, string $prefix) {
    echo $prefix . $employee->getName() . "\n";
    $prefix .= '   ';

    foreach ($employee->underlings() as $underling) {
        echoEmployees($underling, $prefix);
    }
}

echoEmployees($ceo, '');
