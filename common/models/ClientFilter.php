<?php

declare(strict_types=1);

namespace common\models;

use yii\base\Model;
use common\models\Client; 

class ClientFilter extends Model
{
    public $id;
    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $birth_date;
    public $status;

    public function rules(): array
    {
        return [
            [['id', 'status'], 'integer'],
            [['first_name', 'last_name', 'email', 'phone'], 'string', 'max' => 255],
            ['birth_date', 'date', 'format' => 'php:Y-m-d'],
            ['status', 'in', 'range' => array_keys(Client::statusList())],
        ];
    }

}