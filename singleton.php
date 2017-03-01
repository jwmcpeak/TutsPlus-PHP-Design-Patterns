<?php

final class ProductDb {

    public static function Instance() {
        static $instance = null;

        if ($instance == null) {
            $instance = new ProductDb();
        }

        return $instance;
    }

    private $db = null;
    private function __construct() {
        // set $db
    }

    public function query(string $sql) {
        echo "Performing query: $sql";
    }

    public function execute(string $sql) {
        echo "Executing statement: $sql";
    }
}


$db1 = ProductDb::Instance();
//$db2 = ProductDb::Instance();

//echo $db1 == $db2;

$db1->query('SELECT * FROM ProductTypes');