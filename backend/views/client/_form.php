<?php
declare(strict_types=1);

/** @var common\models\Client $model */

use common\models\Client;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

$form = ActiveForm::begin([
    'id' => 'client-form',
]) ?>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'first_name') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'last_name') ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'email') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'phone') ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'birth_date')->input('date') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'status')->dropDownList([
                Client::STATUS_ACTIVE => Client::STATUS_ACTIVE_LABEL,
                Client::STATUS_INACTIVE => Client::STATUS_INACTIVE_LABEL,
            ]) ?>
        </div>
    </div>        
    <div class="row">
        <?= $form->field($model, 'notes')->textarea(['rows' => 6]) ?>
    </div>
    <div class="mt-3">
        <?= Html::submitButton('Save', [
            'class' => 'btn btn-primary',
        ]) ?>
    </div>
<?php ActiveForm::end() ?>