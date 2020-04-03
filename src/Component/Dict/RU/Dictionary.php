<?php
namespace Component\Dict\RU;

class Dictionary {
    //Основные Кнопки
    const GET_EXCHANGE_MAIN_BUTTON =
        [
            'text' => 'Узнать курс',
            'callback_data' => 'Узнать курс'
        ];

    const CALCULATE_MAIN_BUTTON =
        [
            'text' => 'Пересчитать',
            'callback_data' => 'Пересчитать'
        ];


    //Кнопки с популярными валютами
    const EUR_BUTTON = [
        'name' => 'Евро (EUR)',
        'abbr' => 'EUR'
    ];
    const USD_BUTTON = [
        'name' => 'Доллар США (USD)',
        'abbr' => 'USD'
    ];
    const GBP_BUTTON = [
        'name' => 'Фунт Стерлиногов (GBP)',
        'abbr' => 'GBP'
    ];
    const JPY_BUTTON = [
        'name' => 'Япноские иены (JPY)',
        'abbr' => 'JPY'
    ];
    const OTHER_BUTTON = [
        'name' => 'Весь список',
        'abbr' => 'Other'
    ];

    /**
     * Приветсвие
     */
    const HELLO = 'Добро пожаловать в Mighty Exchanger 1.1';

}