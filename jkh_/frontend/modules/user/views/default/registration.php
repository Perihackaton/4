<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 18.08.14
 * Time: 20:18
 */
use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>
<?php $form = ActiveForm::begin([
    'options' => [
        'novalidate' => "novalidate",
        'method' => "post",
        'data-validate' => "parsley",
    ]
]); ?>
<h1 style="color: #fff;">Регистрация</h1>
<div class="row">
    <div>
        <?=$form->errorSummary($model);?>
    </div>
    <div class="col-lg-12">
        <?= $form->field($model, 'phone', [
            'template' => '
        <div>{label}</div>
        {input}
        <div>{error}</div>
                    '
        ])->widget(\yii\widgets\MaskedInput::className(), [
            'mask' => '+7(999)-999-9999',
            'model' => $model,
            'attribute' => 'phone',
            'options' => [
                'placeholder' =>'+7(___)-___-____',
                'class' => 'input-type-text-medium'
            ]
        ]) ?>
    </div>
    <?= $form->field($model, 'email')?>
    <?= $form->field($model, 'username')?>
    <?= $form->field($model, 'password')->passwordInput()?>
    <?= $form->field($model, 'password_repeat')->passwordInput()?>
    <?= $form->field($model, 'address_index')?>
    <?= $form->field($model, 'address_city')?>
    <?= $form->field($model, 'address_street')?>
    <?= $form->field($model, 'address_area')?>
    <?= $form->field($model, 'address_house')?>
    <?= $form->field($model, 'address_building')?>
    <?= $form->field($model, 'address_flat_number')?>


</div>

<div class="form-group">
    <?= Html::submitButton('Регистрация', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
</div>
<?php ActiveForm::end(); ?>
