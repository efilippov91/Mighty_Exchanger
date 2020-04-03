<?php
namespace Exchanger\Rates;

interface xmlPageInterface
{

    /**
     * Устанавливаем страничку из хранилища
     *
     * @return string
     */
    public function getStoragePage($content): ?string;

    /**
     * Качаем страничку
     */
    public function downLoadPage(): string ;
}