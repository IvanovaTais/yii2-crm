<?php
/** @var common\models\Client $model */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Edit Client: #' . $model->id;

?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="d-flex justify-content-between mb-3">
    <div>
        <?= Html::a('Back', Url::previous('client-index') ?: ['index'], ['class' => 'btn btn-outline-secondary']) ?>
    </div>
</div>

<?= $this->render('_form', [
    'model' => $model,
]) ?>