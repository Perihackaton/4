<?php
/**
 * Created by PhpStorm.
 * User: Phantom
 * Date: 31/01/16
 * Time: 03:32
 */
?>

<!-- Register modal section start -->
<div id="myModal" class="modal fade" hidden="true">
    <?php $form = \yii\widgets\ActiveForm::begin([
        'options' => [
            'novalidate' => "novalidate",
            'method' => "post",
            'data-validate' => "parsley",
        ]
    ]); ?>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title">&nbsp;</h3></div>
            <div class="modal-body">
                <div class="contact-form centered">
                    <h3>Регистрация</h3>
                    <div id="successSend" class="alert alert-success invisible">
                        <strong>Well done!</strong>Your message has been sent.</div>
                    <div id="errorSend" class="alert alert-error invisible">There was an error.</div>
                    <form id="contact-form">
                        <div class="control-group">
                            <div class="controls">
                                <input class="span4" type="text" id="name" name="name" placeholder="* Имя" />
                                <div class="error left-align" id="err-name">Введите имя.</div>
                            </div>
                        </div>
                        <div class="control-group">
<!--                            <div class="controls">-->
<!--                                --><?//= $form->field($model, 'phone', [
//                                    'template' => '
//                                <div>{label}</div>
//                                {input}
//                                <div>{error}</div>
//                    '
//                                ])->widget(\yii\widgets\MaskedInput::className(), [
//                                    'mask' => '+7(999)-999-9999',
//                                    'model' => $model,
//                                    'attribute' => 'phone',
//                                    'options' => [
//                                        'placeholder' =>'+7(___)-___-____',
//                                        'class' => 'input-type-text-medium'
//                                    ]
//                                ]) ?>
                                <div class="error left-align" id="err-email">Введите номер телефона.</div>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <input class="span4" type="password" id="password" placeholder="* Пароль">
                                <div class="error left-align" id="err-comment">Введите пароль.</div>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <input class="span4" type="password" name="passwordrepeat" id="passwordrepeat" placeholder="* Повторите пароль">
                                <div class="error left-align" id="err-comment">Повторите пароль.</div>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <button id="send-mail" class="button">Зарегистрироваться</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php \yii\widgets\ActiveForm::end(); ?>
</div>

