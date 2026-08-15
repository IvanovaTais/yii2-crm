<?php
declare(strict_types=1);

namespace console\controllers;

use yii\console\Controller;
use common\models\Client;
use common\models\ClientOrder;

class ClientOrderController extends Controller
{
    public function actionGenerate($count = 100)
    {
        echo "Hello from actionGenerate\n";

        $faker = \Faker\Factory::create();

        $createCount = 0;

        $clientIds = Client::find()
            ->select('id')
            ->column();

        if (empty($clientIds)) {
            echo "No clients found. Create clients first.\n";
            return;
        }

        for ($i = 0; $i < $count; $i++) {
            if ($this->generateOrder($faker, $clientIds)) {
                $createCount++;
            }
        }

        echo "Created {$createCount} orders.\n";
    }

    private function generateOrder(
        \Faker\Generator $faker,
        array $clientIds
    ): bool {
        $order = new ClientOrder();

        $order->client_id = $faker->randomElement($clientIds);
        $order->order_date = $faker->dateTimeBetween('-1 year', 'now')
            ->format('Y-m-d H:i:s');
        $order->total_amount = $faker->randomFloat(2, 50, 10000);
        $order->status = $faker->randomElement(
            array_keys(ClientOrder::statusList())
        );

        return $order->save();
    }
}
?>