<?php

namespace Exchanger\Rates\ValueObject;

use Exchanger\Rates\ValueObject\Rate;

class RateFabric
{
    public function createRate(string $charCode, array $parsedRates): Rate
    {
        return new Rate ($parsedRates[$charCode]['Name'],       //Наименование
                         $parsedRates[$charCode]['CharCode'],   //Аббревиатура
                         $parsedRates[$charCode]['Value'],      //Курс
                         $parsedRates[$charCode]['Nominal']);   //Номинал
    }
}