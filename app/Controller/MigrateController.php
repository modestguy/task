<?php
namespace App\Controller;

use App\Model\Enum\OrderType;
use App\Model\Good;
use App\Model\Order;
use App\Model\OrderGoods;
use Illuminate\Database\Capsule\Manager as DBManager;
use Illuminate\Database\Schema\Blueprint;
use Symfony\Component\HttpFoundation\Response;

class MigrateController {

    public function migrate() : Response
    {
        $schema = DBManager::schema();


        $schema->create(Good::getTableName(), function(Blueprint $table) {
            $table->increments('id')->comment('Идентификатор');
            $table->string('name')->nullable(false)->comment('Название');
            $table->double('price')->nullable(false)->comment('Цена в руб.');
        });

        $schema->create(OrderType::getTableName(), function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        $schema->getConnection()->table(OrderType::getTableName())->insert([
            ['id' => OrderType::NEW, 'name' => 'Новый заказ'],
            ['id' => OrderType::PAID, 'name' => 'Заказ оплачен']
        ]);


        $schema->create(Order::getTableName(), function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_type_id')->unsigned()
                ->default(OrderType::NEW)
                ->comment('Тип заказа');
            $table->double('sum')->default(0)->comment('Сумма оплаченного заказа');
        });

        $schema->table(Order::getTableName(), function (Blueprint $table) {
            $table->foreign('order_type_id')->references('id')->on(OrderType::getTableName());
        });

        $schema->create(OrderGoods::getTableName(), function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('order_id')->comment('Идентификатор заказа');
            $table->unsignedInteger('good_id')->comment('Идентификатор товара');
        });

        $schema->table(OrderGoods::getTableName(), function (Blueprint $table) {
            $table->foreign('order_id')->references('id')->on(Order::getTableName());
            $table->foreign('good_id')->references('id')->on(Good::getTableName());
        });

        return new Response('Миграции прошли успешно!');
    }
}