<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Класс "Товар"
 * @property int $id Идентификатор товара
 * @property string $name Название
 * @property double $price Цена в руб.
 */
class Good extends BaseModel
{
    /**
     * Количество генерируемых товаров
     * @const
     */
    public const GENERATED_COUNT = 20;

    protected $table = 'goods';

    protected $fillable = ['price', 'name'];

    public $timestamps = false;

    /**
     * Отнощение на получение всех заказов
     * @return BelongsTo
     */
    public function orders() : BelongsTo
    {
        return $this->belongsToMany(Order::class)
            ->using(OrderGoods::class);
    }
}