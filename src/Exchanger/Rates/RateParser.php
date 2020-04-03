<?php
namespace Exchanger\Rates;

use Symfony\Component\DomCrawler\Crawler;

class RateParser implements RateParserInterface
{

    public $exchangeData;

    public $rebuildData;

    public function __construct(string $page)
    {
        $this->parsePage($page);
    }

    /**
     * Парсим страничку с курсами валют
     *
     * @param $page
     */
    public function parsePage($page): void
    {
        (new Crawler($page))
            ->filterXPath('//ValCurs/Valute')
            ->each(function (Crawler $node) {
                $this->exchangeData[$node->filterXPath('*/CharCode')->text()] = [
                    'NumCode'  => $node->filterXPath('*/NumCode')->text(),
                    'Nominal'  => $node->filterXPath('*/Nominal')->text(),
                    'Name'     => $node->filterXPath('*/Name')->text(),
                    'Value'    => $node->filterXPath('*/Value')->text(),
                    'CharCode' => $node->filterXPath('*/CharCode')->text(),
                ];
            });
    }

    /**
     * Получить все курсы валют
     *
     * @return array
     */
    public function buildExchangeData(): array
    {
        foreach ($this->exchangeData as $name =>$data) {
            $this->rebuildData[] = $name. ' ' .$data['Name']. ': '. $data['Value'];
        }

        return $this->rebuildData;
    }
}