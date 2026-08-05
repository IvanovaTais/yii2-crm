<?php
declare(strict_types=1);

namespace console\controllers;

use yii\console\Controller;
use common\models\Client;

class ClientController extends Controller
{
    public function actionGenerate($count = 50)
    {
        echo "Hello from actionGenerate\n";

        $faker = \Faker\Factory::create();

        $createCount = 0;

        for ($i = 0; $i < $count; $i++) {
            $this->generateClient($faker);
            $createCount++;
        }

        echo "Created {$createCount} clients.\n";
    }

    private function generateClient(\Faker\Generator $faker): bool
    {
        $client = new Client();
        $client->first_name = $faker->firstName;
        $client->last_name = $faker->lastName;
        $client->email = $faker->unique()->safeEmail;
        $client->phone = $faker->phoneNumber;
        $client->birth_date = $faker->date();
        $client->status = $faker->randomElement([Client::STATUS_ACTIVE, Client::STATUS_INACTIVE]);
        $client->notes = $faker->text();
        return $client->save();
    }
}
?>