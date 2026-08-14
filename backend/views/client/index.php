<?php
/** @var yii\data\ActiveDataProvider $dataProvider */

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Client;
use yii\bootstrap5\LinkPager;
use yii\grid\ActionColumn;

$this->title = 'Clients List';

?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="d-flex gap-2 mb-3">
    <?= Html::a('Create Client', ['create'], ['class' => 'btn btn-primary']) ?>
    <?php if (Yii::$app->request->get('sort')): ?>
        <?= Html::a(
            'Reset sorting',
            ['index'],
            ['class' => 'btn btn-outline-secondary']
        ) ?>
    <?php endif; ?>
</div>

<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'pager' => [
            'class' => LinkPager::class,
        ],
        'columns' => [
            'first_name',
            'last_name',
            [
                'attribute' => 'email',
                'format' => 'text',
                'enableSorting' => false
            ],            
            'phone',
            [
                'attribute' => 'birth_date',
                'format' => ['date', 'php:Y-m-d']
            ],            
            'notes:ntext',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return Html::tag(
                        'span',
                        $model->statusLabel,
                        [
                            'class' => $model->status === Client::STATUS_ACTIVE
                                ? 'badge bg-success'
                                : 'badge bg-danger',
                        ]
                    );
                },
                'format' => 'raw',
            ],   
            'created_at:datetime',
            [
                'class' => ActionColumn::class,
            ],
        ],
    ]);
?>
