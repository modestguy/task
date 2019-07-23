<?php
namespace App\Model\Enum;

/**
 *  Класс "Тип заказа"
 */
class OrderType extends BaseEnum
{
    /**
     * Имя таблицы
     * @var string
     */
    protected $table = 'order_type';

    /**
     * Новый заказ
     * @const
     */
    public const NEW = 1;

    /**
     * Заказ оплачен
     * @const
     */
    public const PAID = 2;
}