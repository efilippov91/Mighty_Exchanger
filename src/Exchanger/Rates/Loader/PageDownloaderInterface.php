<?php
namespace Exchanger\Rates\Loader;

interface PageDownloaderInterface
{
    /**
     * Качаем страничку
     */
    public function downLoadPage(): string;
}