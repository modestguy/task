<?php
namespace App;

class Helpers {

    /**
     * @param array $items
     * @return array
     */
    public static function items(array $items) : array
    {
        return compact('items');
    }

    /**
     * @param int $id
     * @return array
     */
    public static function id(int $id) : array
    {
        return compact('id');
    }

    /**
     * @param string $error
     * @return array
     */
    public static function error(string $error) : array
    {
        return compact('error');
    }

    /**
     * @param string $success
     * @return array
     */
    public static function success(string $success) : array
    {
        return compact('success');
    }

    /**
     * @param string $config
     * @param string $key
     * @return null
     */
    public static function config(string $config, string $key)
    {
        $data = include '../config/' . $config . '.php';
        return $data[$key] ?? null;
    }
}