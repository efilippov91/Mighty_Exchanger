<?php
declare(strict_types = 1);

namespace Exchanger\Rates\Loader;

use Exchanger\Rates\Parser\RateParser;
use Memcached;

class PageCacheProxy implements PageDownloaderInterface
{
    public $memcached;

    public $downloader;

    /**
     * PageCacheProxy constructor.
     *
     * @param PageDownloader $downloader
     */
    public function __construct(PageDownloader $downloader)
    {
        $this->downloader = $downloader;
        $this->memcached = new Memcached();
        $this->memcached->addServer($_ENV['MEMCACHED_HOST'], 11211);
    }

    /**
     * Пробуем получить страничку из хранлища
     * Если её там нет -> качаем -> парсим
     *
     * @return array
     */
    public function downloadPage(): string
    {
        $key = 'Rate' . date('d/m/Y');
        $data = $this->memcached->get($key);
        if ($data == null) {
            $data = $this->downloader->downLoadPage();
            $this->memcached->add($key, $data, 86400);
        }

        return $data;
    }
}
