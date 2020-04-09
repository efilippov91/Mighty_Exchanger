<?php
declare(strict_types = 1);

namespace Exchanger\Rates\Loader;

use Component\Logger\MainLogger;
use GuzzleHttp\Client;

class PageDownloader implements PageDownloaderInterface
{
    /**
     * Ссылка на XML
     * @var string
     */
    const LINK = 'http://www.cbr.ru/scripts/XML_daily.asp?date_req=';

    /**
     * Забираем данные из хранилища
     *
     * @return string
     */
    public function downLoadPage(): string
    {
        try {
            $url = self::LINK . date('d/m/Y');
            $content = (new Client())->get($url);
            $page = $content->getBody()->getContents();
        } catch (\Exception $e) {
            (new MainLogger())->guzzleError($e->getMessage());
        }

        return $page;
    }
}