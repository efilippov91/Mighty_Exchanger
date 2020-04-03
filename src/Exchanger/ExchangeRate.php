<?php

namespace Exchanger;

use Exchanger\Rates\XmlPage;
use Exchanger\Rates\RateParser;
use Exchanger\Storage\Proxy;
use Exchanger\Rates\Config\RatesConfig;

class ExchangeRate
{

    /**
     * Value Object содержит страницы после парсинга
     */
    public $parsedRates;

    /**
     * Проверяем Кэш
     * Получаем страничку
     * Парсим
     *
     * @return RateParser
     */
    public function processing(): RateParser
    {
        $config = new RatesConfig();
        $storage = new Proxy($config);
        $page    = (new XmlPage())->getStoragePage($storage->getData());
        $content = $storage->equal($page);
        return new RateParser($content);
    }

}