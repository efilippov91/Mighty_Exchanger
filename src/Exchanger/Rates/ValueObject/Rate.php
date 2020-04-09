<?php
declare(strict_types = 1);

namespace Exchanger\Rates\ValueObject;

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

    public function __construct(string $name, string $charCode, string $value, string $nominal)
    {
      $this->name     = $name;
      $this->charCode = $charCode;
      $this->value    = $value;
      $this->nominal  = $nominal;
    }

}
