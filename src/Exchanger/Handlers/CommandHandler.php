<?php
namespace Exchanger\Handlers;

use Exchanger\Keyboards\MainKeyboard;
use Exchanger\Keyboards\PopCurrKeyboard;
use Exchanger\ExchangeRate;
use Component\Dict\RU\Dictionary;
use Exchanger\Rates\Rate;
use TelegramBot\Api\Client;

class CommandHandler
{

    /**
     * Объект клиента апи
     *
     * @var \TelegramBot\Api\Client
     */
    public $botClient;

    /**
     * Ообъект курсов валют
     *
     * @var ExchangeRate
     */
    public $rates;

    public function __construct(Client $botClient)
    {
        $this->rates = (new ExchangeRate())->processing();
        $this->botClient = $botClient;
    }

    /**
     * Обработка основных команд и коллбэков
     */
    public function start()
    {
        $bot   = $this->botClient;
        $rates = $this->rates;

        $bot->command('start', function ($message) use($bot) {
            $bot->sendMessage($message->getChat()->getId(), Dictionary::HELLO, null, false, null, (new MainKeyboard())->getKeyboard());
        });

        $bot->callbackQuery( function ($callBack) use($bot, $rates) {
            $data = $callBack->getData();

            if ($data == Dictionary::OTHER_BUTTON['abbr']) {
                $bot->sendMessage($callBack->getMessage()->getChat()->getId(), implode(PHP_EOL, $rates->buildExchangeData()));
                return;
            }
            $rate = new Rate($data, $rates);
            $bot->answerCallbackQuery($callBack->getId(), $data.' '.$rate->value, false);

            return;
        });
        $this->handleMainCommands();
    }


    /**
     * Обработка команд главного меню
     */
    public function handleMainCommands()
    {
        $bot = $this->botClient;
        $bot->on(function($update) use ($bot) {
            $message = $update->getMessage();
            switch ($message->getText()) {
                case Dictionary::GET_EXCHANGE_MAIN_BUTTON['text']:
                    $bot->sendMessage($message->getChat()->getId(), 'Выберите валюту', null, false, null, (new PopCurrKeyboard())->getKeyboard());
                    break;
            }
        }, function($message) {

            return true;
        });
    }
}