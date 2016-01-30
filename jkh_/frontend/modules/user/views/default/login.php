<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 18.08.14
 * Time: 18:02
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<span>Еще не создали аккаунт? <a href="/user/registration.html">Регистрация</a></span>
<?php $form = ActiveForm::begin([
    'options' => [
        'novalidate' => "novalidate",
        'method' => "post",
        'data-validate' => "parsley",
    ]
]); ?>
<h1 style="color: #fff;">Вход</h1>
<div class="row">
    <div>
        <?=$form->errorSummary($model);?>
    </div>
    <div class="col-lg-6">
        <?= $form->field($model, 'phone')->textInput() ?>
    </div>
    <div class="col-lg-6">
        <?= $form->field($model, 'password', [
            'template' => '
                {label}
                {input}
                {error}'
        ])->passwordInput() ?>
    </div>
</div>
<?= $form->field($model, 'rememberMe')->checkbox() ?>

<div class="form-group">
    <?= Html::submitButton('Вход', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
</div>
<?php ActiveForm::end(); ?>
