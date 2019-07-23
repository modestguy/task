<?php
namespace App\Controller\Api;

use App\Helpers;
use App\Model\Enum\OrderType;
use App\Model\Good;
use App\Model\Order;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Database\Capsule\Manager as DBManager;
use Symfony\Component\HttpFoundation\Response;


/**
 * Контроллер заказов
 */
class OrderController extends BaseController {

    /**
     * Создать заказ
     * Возвращает идентификатор созданного заказа
     * @return JsonResponse
     * @throws \Throwable
     */
    public function create() : JsonResponse
    {
        $order = new Order(['order_type_id' => OrderType::NEW]);
        try {
            DBManager::schema()->getConnection()->transaction(function() use ($order){
                $order->save();
                $order->goods()->sync($this->request()->get('goods'));
            });

            return $this->response(Helpers::id($order->id));

        } catch (\Exception $e)
        {
            return $this->response(Helpers::error($e->getMessage()));
        }
    }

    /**
     * Оплата заказа
     * @return JsonResponse
     */
    public function pay() : JsonResponse
    {
        $sum  = $this->request()->get('sum');

        /** @var Order $order */
        $order = Order::query()->find($this->request()->get('id'));
        if (!$order)
            return $this->response(Helpers::error('Нет такого заказа'));

        $calcSum = $order->goods->sum(function(Good $good){
            return $good->price;
        });

        if ($sum == $calcSum)
        {
            try {
                $response = $this->client->request('GET',
                    Helpers::config('urls', 'YA_RU')
                );

                if ($response->getStatusCode() === Response::HTTP_OK) {
                    $order->paid($calcSum);
                    return $this->response(Helpers::success('Заказ оплачен успешно!'));
                }
            } catch (GuzzleException $e) {
                return $this->response(Helpers::error($e->getMessage()));
            }
        }

        return $this->response(Helpers::error('Сумма оплаты заказа не совпадает'));
    }


}