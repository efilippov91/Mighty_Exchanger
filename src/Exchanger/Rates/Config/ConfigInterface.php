<?php
namespace Exchanger\Rates\Config;

interface ConfigInterface
{
    /**
     * Возвращаем ключ
     *
     * @return string
     */
    public function getKey(): string;

    /**
     * Возвращаем метод
     *
     * @return array
     */
    public function getMethod(): array;

}