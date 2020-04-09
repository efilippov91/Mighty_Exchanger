<?php
namespace Exchanger\Rates\Parser;

use Symfony\Component\DomCrawler\Crawler;

class RateParser
{
    /**
     * @var array
     */
    public $exchangeData = [];

    /**
     * Парсим страничку с курсами валют
     *
     * @param string $page
     * @return array
     */
    public function parsePage(string $page)
    {
        (new Crawler($page))
            ->filterXPath('//ValCurs/Valute')
            ->each(function (Crawler $node) {
                $this->exchangeData[$node->filterXPath('*/CharCode')->text()] = [
                    'NumCode' => $node->filterXPath('*/NumCode')->text(),
                    'Nominal' => $node->filterXPath('*/Nominal')->text(),
                    'Name' => $node->filterXPath('*/Name')->text(),
                    'Value' => $node->filterXPath('*/Value')->text(),
                    'CharCode' => $node->filterXPath('*/CharCode')->text(),
                ];
            });
        return $this->exchangeData;
    }
}