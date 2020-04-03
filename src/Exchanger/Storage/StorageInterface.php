<?php

namespace Exchanger\Storage;

interface StorageInterface
{

    /**
     * Получаем данные из хранилища
     *
     * @param $key
     * @return mixed
     */
    public function getData();

    /**
     * Добавляем данные в хранилище
     *
     * @param $key
     * @param $data
     * @return mixed
     */
    public function addData($key, $data);

    /**
     * Проверяем есть ли данные в хранилище, если нет то получаем их.
     *
     * @param $data
     * @param $method
     * @return mixed
     */
    public function equal($data);
}