<?php
namespace Exchanger\Rates;

use GuzzleHttp\Client;

class XmlPage implements XmlPageInterface
{
    /**
     * Ссылка на XML
     * @var string
     */
    const LINK = 'http://www.cbr.ru/scripts/XML_daily.asp?date_req=';

    /**
     * Сырые данные из XML
     *
     * @var string
     */
    public $content = '';

    /**
     * Забираем данные из кэша
     *
     * @return string|null
     */
    public function getStoragePage($content): ?string
    {
        return $this->content = $content;
    }

    /**
     * Забираем данные из хранилища
     *
     * @return string
     */
    public function downLoadPage(): string
    {
        $url = self::LINK . date('d/m/Y');
        $content = (new Client())->get($url);
        $this->content = $content->getBody()->getContents();
        return $this->content;

    }
}