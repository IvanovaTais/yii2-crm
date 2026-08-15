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
        <?= Html::a('Update Client Info', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete Client', ['delete', 'id' => $model->id], [
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

<h3 class="mt-4">Orders</h3>

<?php if ($model->orders): ?>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Order Date</th>
            <th>Total Amount</th>
            <th>Status</th>
        </tr>
        </thead>

        <tbody>
        <?php foreach ($model->orders as $order): ?>
            <tr>
                <td><?= Html::encode($order->id) ?></td>
                <td><?= Html::encode(Yii::$app->formatter->asDatetime($order->order_date)) ?></td>
                <td><?= Html::encode($order->total_amount) ?></td>
                <td><?= Html::encode($order->statusLabel) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

<?php else: ?>

    <p class="text-muted">This client has no orders yet.</p>

<?php endif; ?>