<?php
namespace Exchanger\Handlers;

use Exchanger\Keyboards\MainKeyboard;
use Exchanger\Keyboards\PopCurrKeyboard;
use Component\Dict\RU\Dictionary;
use Exchanger\Rates\Loader\PageDownloader;
use Exchanger\Rates\Loader\PageCacheProxy;
use Exchanger\Rates\Parser\RateParser;
use TelegramBot\Api\Client;
use Exchanger\Rates\ValueObject\RateFabric;

class CommandHandler
{

    /**
     * Объект клиента апи
     *
     * @var \TelegramBot\Api\Client
     */
    private $botClient;

    /**
     * Все курсы валют
     *
     * @var string
     */
    private $rates;

    public function __construct(Client $botClient)
    {
        $this->rates = (new RateParser())->parsePage((new PageCacheProxy(new PageDownloader()))->downloadPage());
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
                $bot->sendMessage($callBack->getMessage()->getChat()->getId(), self::buildExchangeData($rates));
                return;
            }
            $rate = (new RateFabric())->createRate($data, $rates);
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

    /**
     * Преобразуем данные о курсах валют
     * в удобной для чтения в 1м сообщении вид
     *
     * @param $rates
     * @return string
     */
    private function buildExchangeData($rates): string
    {
        $rebuildData = [];
        foreach ($rates as $name =>$data) {
            $rebuildData[] = $name. ' ' .$data['Name']. ': '. $data['Value'];
        }

        return implode(PHP_EOL, $rebuildData);
    }
}