<?php
namespace Exchanger\Rates;

class Rate
{
    /**
     * Наименование
     */
    public $name;

    /**
     * Аббревиатура
     */
    public $charCode;

    /**
     * Курс
     */
    public $value;

    /**
     * Номинал
     */
    public $nominal;

    public function __construct(string $charCode, RateParser $parsedRates)
    {
        $this->name     = $parsedRates->exchangeData[$charCode]['Name'];
        $this->charCode = $parsedRates->exchangeData[$charCode]['CharCode'];
        $this->value    = $parsedRates->exchangeData[$charCode]['Value'];
        $this->nominal  = $parsedRates->exchangeData[$charCode]['Nominal'];
    }

}
