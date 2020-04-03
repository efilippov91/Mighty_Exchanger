<?php
namespace Exchanger\Rates\Config;

class RatesConfig implements ConfigInterface
{
    /**
     * Ключ для зранения курсов
     */
    const KEY = 'Rate';

    /**
     * Метод, как будем качать старничку
     */
    const METHOD = [
        'object' => 'Exchanger\Rates\XmlPage',
        'function' => 'downloadPage'
    ];

    /**
     * Возвращаем ключ
     *
     * @return string
     */
    public function getKey(): string
    {
        return self::KEY;
    }

    /**
     * Возвращаем метод
     *
     * @return array
     */
    public function getMethod(): array
    {
        return self::METHOD;
    }
}