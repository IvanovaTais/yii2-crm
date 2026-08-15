<?php

declare(strict_types=1);

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\helpers\Url;
use common\models\Client;
use common\models\ClientFilter;

/**
 * Client controller
 */
class ClientController extends Controller
{
    /**
     * Displays client list page.
     *
     * @return string
     */
    public function actionIndex(): string
    {
        Url::remember('', 'client-index');

        $filterModel = new ClientFilter();

        $query = Client::find();

        if ($filterModel->load(Yii::$app->request->get()) && $filterModel->validate()) {
            $query
                ->andFilterWhere(['id' => $filterModel->id])
                ->andFilterWhere(['status' => $filterModel->status])
                ->andFilterWhere(['like', 'first_name', $filterModel->first_name])
                ->andFilterWhere(['like', 'last_name', $filterModel->last_name])
                ->andFilterWhere(['like', 'email', $filterModel->email])
                ->andFilterWhere(['like', 'phone', $filterModel->phone])
                ->andFilterWhere(['birth_date' => $filterModel->birth_date]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ],
            ],
        ]);

        return $this->render('index', [
           'dataProvider' => $dataProvider,
            'filterModel' => $filterModel,
        ]);
    }

    /**
     * Displays a single client.
     *
     * @param int $id
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView(int $id): string
    {
        $model = Client::find()
            ->with('orders')
            ->where(['id' => $id])
            ->one();

        if ($model === null) {
            throw new NotFoundHttpException('The requested client does not exist.');
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing client.
     *
     * @param int $id
     * @return string|Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate(int $id): string|Response
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash(
                'success',
                sprintf(
                    'Client "%s %s" has been updated successfully.',
                    $model->first_name,
                    $model->last_name
                )
            );
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new client.
     *
     * @return string|Response
     */
    public function actionCreate(): string|Response
    {
        $model = new Client();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash(
                'success',
                sprintf(
                    'Client "%s %s" has been created successfully.',
                    $model->first_name,
                    $model->last_name
                )
            );

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing client.
     *
     * @param int $id
     * @return Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete(int $id): Response
    {
        $model = $this->findModel($id);

        $name = "{$model->first_name} {$model->last_name}";

        $model->delete();

        Yii::$app->session->setFlash(
            'success',
            sprintf(
                'Client "%s" has been deleted successfully.',
                $name
            )
        );

        return $this->redirect(Url::previous('client-index') ?: ['index']);
    }

    /**
     * Finds the Client model based on its primary key value.
     *
     * @param int $id
     * @return Client
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(int $id): Client
    {
        $model = Client::findOne($id);

        if ($model === null) {
            throw new NotFoundHttpException('The requested client does not exist.');
        }

        return $model;
    }
}
