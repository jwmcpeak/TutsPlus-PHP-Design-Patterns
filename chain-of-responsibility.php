<?php

// chain of handlers
// request

abstract class LogType {
    const Information = 0;
    const Debug = 1;
    const Error = 2;
}

abstract class AbstractLog {
    protected $level;
    private $nextLogger = null;

    public function setNext(AbstractLog $logger) {
        $this->nextLogger = $logger;
    }
    
    public function log(int $level, string $message) {
        if ($this->level <= $level) {
            $this->write("$message\n");
        }

        if ($this->nextLogger != null) {
            $this->nextLogger->log($level, $message);
        }
    }

    protected abstract function write(string $message);
}

class ConsoleLog extends AbstractLog {
    public function __construct(int $logLevel) {
        $this->level = $logLevel;
    }

    protected function write(string $message) {
        echo "CONSOLE: $message";
    }
}

class FileLog extends AbstractLog {
    public function __construct(int $logLevel) {
        $this->level = $logLevel;
    }

    protected function write(string $message) {
        echo "FILE: $message";
    }
}

class EventLog extends AbstractLog {
    public function __construct(int $logLevel) {
        $this->level = $logLevel;
    }

    protected function write(string $message) {
        echo "EVENT: $message";
    }
}

class AppLog {
    private $logChain;
    public function __construct() {
        $console = new ConsoleLog(LogType::Information);
        $debug = new FileLog(LogType::Debug);
        $error = new EventLog(LogType::Error);

        $console->setNext($debug);
        $debug->setNext($error);

        $this->logChain = $console;
    }

    public function log(int $level, string $message) {
        $this->logChain->log($level, $message);
    }
}


$app = new AppLog();

$app->log(LogType::Information, "This is information.");
$app->log(LogType::Debug, "This is debug.");
$app->log(LogType::Error, "This is error.");



