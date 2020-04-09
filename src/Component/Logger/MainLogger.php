<?php
namespace Component\Logger;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class MainLogger
{
    const GUZZLE_LOG = __DIR__.'/Logs/GuzzleLog';

    /**
     * Класс логгера
     *
     * @var Logger
     */
    public $log;

    public function __construct()
    {
        $this->log = new Logger('Logger');
    }

    /**
     * Обработка ошибок от Guzzle
     *
     * @param $errorText
     */
    public function guzzleError($errorText)
    {
        $this->log->pushHandler(new StreamHandler(self::GUZZLE_LOG, Logger::ERROR));
        $this->log->error($errorText);
    }

}