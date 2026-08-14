<?php

declare(strict_types=1);

namespace backend\modules\api\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use yii\data\ActiveDataFilter;
use yii\web\BadRequestHttpException;
use common\models\Client;
use common\models\ClientFilter;

class ClientController extends ActiveController
{
    public $modelClass = Client::class;

    public function actions(): array
    {
        $actions = parent::actions();
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        return $actions;
    }

    public function prepareDataProvider(): ActiveDataProvider
    {
        $query = $this->modelClass::find();

        $filter = new ActiveDataFilter([
            'searchModel' => ClientFilter::class,
        ]);

        if ($filter->load(Yii::$app->request->get())) {
            $condition = $filter->build();

            if ($condition === false) {
                throw new BadRequestHttpException(
                    implode(' ', $filter->getErrors('filter'))
                );
            }

            $query->andWhere($condition);
        }

        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'defaultPageSize' => 8,
                'pageSizeLimit' => [1, 100],
            ],
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ],
                'attributes' => [
                    'id',
                    'first_name',
                    'last_name',
                    'email',
                    'birth_date',
                    'status',
                    'created_at',
                ],
            ],
        ]);
    }
}
