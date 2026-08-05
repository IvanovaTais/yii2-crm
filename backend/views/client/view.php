<?php
/** @var common\models\Client $model */

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

$this->title = 'Client: #' . $model->id . ' - ' . $model->first_name . ' ' . $model->last_name;

?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="d-flex justify-content-between mb-3">
    <div>
        <?= Html::a('Back', Url::previous('client-index') ?: ['index'], ['class' => 'btn btn-outline-secondary']) ?>
    </div>
    <div class="d-flex gap-2">
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </div>
</div>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'first_name',
        'last_name',
        'email:email',
        'phone',
        'birth_date:date',
        'notes:ntext',
    ],
]) ?>