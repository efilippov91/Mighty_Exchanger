<?php
namespace Exchanger\Rates;

interface RateParserInterface
{

    public function __construct(string $page);

    /**
     * Парсим xml страничку
     *
     * @param $page
     * @return mixed
     */
    public function parsePage($page): void;
}