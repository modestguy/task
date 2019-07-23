<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Товары конкретного заказа
 * @property int $order_id Идентификатор заказа
 * @property int $good_id Идентификатор товара
 * @property Good $good Товар
 * @property Order $order Заказ
 */
class OrderGoods extends BasePivot
{
    protected $table = 'good_order';

    /**
     * Отношение на получение заказа
     * @return BelongsTo
     */
    public function order() : BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Отношение на получение товара
     * @return BelongsTo
     */
    public function good() : BelongsTo
    {
        return $this->belongsTo(Good::class);
    }
}