<?php

namespace Exchanger\Keyboards;

use TelegramBot\Api\Types\ReplyKeyboardMarkup;
use Component\Dict\RU\Dictionary;

class MainKeyboard
{
    /**
     * Массив с кнопками
     * @var array
     */
    public $mainButtons = [[
        [
            'text'          => Dictionary::GET_EXCHANGE_MAIN_BUTTON['text'],
            'callback_data' => Dictionary::GET_EXCHANGE_MAIN_BUTTON['callback_data'],
        ],
    ]];

    /**
     * Получаем клавиатуру
     *
     * @return ReplyKeyboardMarkup
     */
    public function getKeyboard(): ReplyKeyboardMarkup
    {
        $keyboard = new ReplyKeyboardMarkup($this->mainButtons, true, true);
        return $keyboard;
    }
}