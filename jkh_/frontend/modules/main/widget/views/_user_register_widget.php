<?php
/**
 * Created by PhpStorm.
 * User: Phantom
 * Date: 31/01/16
 * Time: 03:32
 */
Yii::$app->view->registerJs('

$(document).on("submit", ".register form", function(e){
    e.preventDefault();
    e.stopImmediatePropagation();

    $(document).find(".ajax-loader-2").parent().show();
    $(document).find(".message-area-2").html("");
    var username = $(document).find("#signupform-username").val();
    var phone = $(document).find("#signupform-phone").val();
    var password = $(document).find("#signupform-password").val();
    var password_repeat = $(document).find("#signupform-password_repeat").val();
    $.ajax({
        type: "POST",
        url: "/user/default/registration/",
        dataType: "json",
        data: {username: username, phone: phone, password: password, password_repeat: password_repeat},
        success: function (result) {
            if (result.error) {
                $(document).find(".ajax-loader-2").parent().hide();
                $(document).find(".message-area-2").html(result.message);
            }
        }
    });
});

', \yii\web\View::POS_END, 'register_user');
?>

<!-- Register modal section start -->
<div id="myModal" class="modal fade register" hidden="true">
    <?php $form = \yii\widgets\ActiveForm::begin([
        'options' => [
            'enableClientValidation' => true,
            'novalidate' => "novalidate",
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
                    <div class="message-area-2" style="color: #1F2340; margin-bottom: 15px"></div>
                    <form id="contact-form">
                        <div class="control-group">
                            <div class="controls">
                                <?= $form->field($user, 'username')->textInput(['placeholder' => 'ФИО'])->label(false)?>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <?= $form->field($user, 'phone', [
                                    'template' => '
                                {input}
                                <div>{error}</div>
                    '
                                ])->widget(\yii\widgets\MaskedInput::className(), [
                                    'mask' => '+7(999)-999-9999',
                                    'model' => $user,
                                    'attribute' => 'phone',
                                    'options' => [
                                        'placeholder' =>'+7(___)-___-____',
                                        'class' => 'input-type-text-medium'
                                    ]
                                ]) ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <?= $form->field($user, 'password')->passwordInput(['placeholder' => 'Пароль'])->label(false)?>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <?= $form->field($user, 'password_repeat')->passwordInput(['placeholder' => 'Повторите пароль'])->label(false)?>
                            </div>
                        </div>
                        <div  hidden="true"><span class="ajax-loader-2">&nbsp;</span></div>
                        <div class="control-group">
                            <div class="controls">
                                <?= \yii\helpers\Html::submitButton('Зарегистрироваться', ['class' => 'button'])?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php \yii\widgets\ActiveForm::end(); ?>
</div>

