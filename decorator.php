<?php

interface IShape {
    function draw();
}

class Circle implements IShape {
    public function draw() {
        return "Drawing circle";
    }
}

class Triangle implements IShape {
    public function draw() {
        return "Drawing triangle";
    }
}

abstract class ShapeDecorator implements IShape {
    protected $shape;

    public function __construct(IShape $shape) {
        $this->shape = $shape;
    }

    abstract function draw();
}

class BorderedShape extends ShapeDecorator {
    public function draw() {
        $result = $this->shape->draw();

        return "$result has border";
    }
}

class RedShape extends ShapeDecorator {
    public function draw() {
        $result = $this->shape->draw();

        return "$result is red";
    }
}

$circle = new Circle();
$circle = new BorderedShape($circle);
$circle = new RedShape($circle);

echo $circle->draw();

$triangle = new Triangle();
$triangle = new BorderedShape($triangle);
$triangle = new RedShape($triangle);

echo $triangle->draw();