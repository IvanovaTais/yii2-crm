<?php

declare(strict_types=1);

namespace common\models;

use yii\base\Model;
use common\models\Client; 

class ClientFilter extends Model
{
    public ?string $first_name = null;
    public ?string $last_name = null;
    public ?string $email = null;
    public ?string $phone = null;
    public ?string $birth_date = null;
    public ?int $status = null;

    public function rules(): array
    {
        return [
            [['first_name', 'last_name', 'email', 'phone'], 'string'],
            ['birth_date', 'date', 'format' => 'php:Y-m-d'],
            ['status', 'in', 'range' => array_keys(Client::statusList())],
        ];
    }

}