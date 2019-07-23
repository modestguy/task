<?php
namespace App\Controller\Api;

use App\Helpers;
use App\Model\Good;
use Symfony\Component\HttpFoundation\JsonResponse;
use Faker\Factory;

/**
 * Контроллер товаров
 */
class GoodController  extends BaseController {

    /**
     * Заполнить таблицу товаров случайными товарами
     * @return JsonResponse
     */
    public function fill() : JsonResponse
    {
        Good::query()->delete();

        $faker = Factory::create();
        try {
            for ($i = 0; $i < Good::GENERATED_COUNT; $i++) {
                (new Good([
                    'price' => mt_rand(0, 10000),
                    'name' => $faker->title
                ]))->save();
            }

        } catch(\Exception $e)
        {
            return $this->response(Helpers::error(
                $e->getMessage())
            );
        }

        return $this->response(Helpers::success(
            'Товары успешно сгенерированы'
        ));
    }

    /**
     * Вернуть список всех товаров
     * @return JsonResponse
     */
    public function index() : JsonResponse
    {
        return $this->response(
            Helpers::items(Good::all()->toArray())
        );
    }
}