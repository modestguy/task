<?php
namespace App\Model\Traits;

trait HasTableName
{
    /**
     * Возвращает имя таблицы для модели
     * @return string
     */
    public static function getTableName() : string
    {
        return with(new static)->getTable();
    }
}