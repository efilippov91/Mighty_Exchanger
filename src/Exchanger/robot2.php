<?php

require '../../vendor/autoload.php';
use Exchanger\ExchangeRate;

var_dump('start');

$dotenv = Dotenv\Dotenv::createImmutable('../../config');
$dotenv->load();

$test = (new ExchangeRate())->processing();

var_dump('stop');
