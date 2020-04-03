<?php

namespace Exchanger\Keyboards;


use \TelegramBot\Api\Types\Inline\InlineKeyboardMarkup;
use Component\Dict\RU\Dictionary;

class PopCurrKeyboard
{

    /**
     * Массив с кнопками
     *
     * @var array
     */
    public $popCurrButtons = [
        [[
            'text'          => Dictionary::EUR_BUTTON['name'],
            'callback_data' => Dictionary::EUR_BUTTON['abbr']
        ]],
        [[
            'text'          => Dictionary::USD_BUTTON['name'],
            'callback_data' => Dictionary::USD_BUTTON['abbr']
        ]],
        [[
            'text'          => Dictionary::GBP_BUTTON['name'],
            'callback_data' => Dictionary::GBP_BUTTON['abbr']
        ]],
        [[
            'text'          => Dictionary::JPY_BUTTON['name'],
            'callback_data' => Dictionary::JPY_BUTTON['abbr']
        ]],
        [[
            'text'          => Dictionary::OTHER_BUTTON['name'],
            'callback_data' => Dictionary::OTHER_BUTTON['abbr']
        ]]
    ];

    /**
     * Получаем клавиатуру
     *
     * @return InlineKeyboardMarkup
     */
    public function getKeyboard(): InlineKeyboardMarkup
    {
        $keyboard = new InlineKeyboardMarkup($this->popCurrButtons);
        return $keyboard;
    }
}