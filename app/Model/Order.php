<?php
namespace App\Model;

use App\Model\Enum\OrderType;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * Класс "Заказ"
 * @property int $id Идентификатор заказа
 * @property int $order_type_id Идентификатор типа заказа
 * @property OrderType $orderType Тип заказа
 * @property Good[]|Collection $goods Товары в заказе
 * @property double $sum Сумма оплаты заказа
 */
class Order extends BaseModel
{
    protected $fillable = ['order_type_id'];

    public $timestamps = false;

    /**
     * Отношение на выборку товаров заказа
     * @return BelongsToMany
     */
    public function goods() : BelongsToMany
    {
        return $this
            ->belongsToMany(Good::class)
            ->using(OrderGoods::class);
    }

    /**
     * Отношение на выборку типа заказа
     * @return BelongsTo
     */
    public function orderType() : BelongsTo
    {
        return $this->belongsTo(OrderType::class);
    }

    /**
     * Заказ оплачен
     * @param float $sum
     */
    public function paid(float $sum)
    {
        $this->order_type_id = OrderType::PAID;
        $this->sum = $sum;
        $this->save();
    }
}