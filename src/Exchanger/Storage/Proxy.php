<?php
namespace Exchanger\Storage;

use Memcached;
use Exchanger\Rates\Config\ConfigInterface;

class Proxy implements StorageInterface
{
    public $memcached;

    public $config;

    /**
     * Proxy constructor.
     *
     * @param ConfigInterface $config
     */
    public function __construct(ConfigInterface $config)
    {
        $this->config = $config;
        $this->memcached = new Memcached();
        $this->memcached->addServer($_ENV['MEMCACHED_HOST'], $_ENV['MEMCACHED_PORT']);
    }

    /**
     * Получает данные из кэша по ключу
     *
     * @param $key
     * @return mixed
     */
    public function getData()
    {
       return $this->memcached->get($this->config->getKey().date('d/m/Y'));
    }

    /**
     * Добавляем данные в хранилище
     *
     * @param $key
     * @param $data
     * @param int $time
     * @return mixed|void
     */
    public function addData($data, $time = 86400): void
    {
        $this->memcached->add($this->config->getKey().date('d/m/Y'), $data, $time);
    }

    /**
     * Проверяем есть ли данные в кэшэ, если нет, то получаем их
     *
     * @param $data
     * @param $method
     * @return mixed
     */
    public function equal($data)
    {
        if ($data == null) {
            $method = $this->config->getMethod();
            $obj = new $method['object'];
            $data = $obj->{$method['function']}();
            $this->addData($data);
        }
        return $data;
    }

}
