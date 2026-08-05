<?php

/** @var common\models\Client $model */

use yii\helpers\Html;

$this->title = 'Create Client';

?>

<h1><?= Html::encode($this->title) ?></h1>

<?= $this->render('_form', [
    'model' => $model,
]) ?>