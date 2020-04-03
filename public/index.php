<?php
require '../vendor/autoload.php';

use Exchanger\Handlers\CommandHandler;
use TelegramBot\Api\Client;

/**
 * Загружаем переменные окружения
 */
$dotenv = Dotenv\Dotenv::createImmutable('../config');
$dotenv->load();

if (isset($_ENV['DEV_MODE'])) {
    $json = file_get_contents('php://input');
    $json = json_decode($json, true);
    file_put_contents('debug.log', var_export($json, true),FILE_APPEND);
}

$bot = new Client($_ENV['API_KEY']);

(new CommandHandler($bot))->start();
$bot->run();