<?php

interface INameListSerializer {
    function output(NameList $nameList);
}

class NameList {
    public $names;
    public function __construct(Array $names) {
        $this->names = $names;
    }

    // public function toString(INameListSerializer $serializer) {
    //     return $serializer->output($this);
    // }
}

class JsonNameListSerializer implements INameListSerializer {
    public function output(NameList $nameList) {
        return json_encode($nameList->names);
    }
}

class CsvNameListSerializer implements INameListSerializer {
    public function output(NameList $nameList) {
        return implode(',', $nameList->names);
    }
}

$names = new NameList(array('Jeremy', 'Jason', 'Jeffrey', 'Jennifer', 'Samantha'));

//echo $names->toString(new CsvNameListSerializer());

$csvSerializer = new CsvNameLIstSerializer();
echo $csvSerializer->output($names);