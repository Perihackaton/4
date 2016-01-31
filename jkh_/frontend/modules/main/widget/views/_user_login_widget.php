<?php

Yii::$app->view->registerJs('

$(document).on("submit", "form.login", function(e){
    e.preventDefault();
    e.stopImmediatePropagation();

    $(document).find(".ajax-loader").parent().show();
    $(document).find(".message-area").html("");
    var phone = $(document).find("#loginform-phone").val();
    var password = $(document).find("#loginform-password").val();
    $.ajax({
        type: "POST",
        url: "/user/default/login/",
        data: {phone: phone, password: password},
        dataType: "json",
        success: function (result) {
            if (result.error) {
                $(document).find(".ajax-loader").parent().hide();
                $(document).find(".message-area").html(result.message);
            }
        }
    });
});

', \yii\web\View::POS_END, 'login_user');

?>

<div id="Modal" class="modal fade" hidden="true">
    <?php $form = \yii\widgets\ActiveForm::begin([
        'options' => [
            'enableClientValidation' => true,
            'novalidate' => "novalidate",
            'data-validate' => "parsley",
            'class' => 'login'
        ]
    ]); ?>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title">&nbsp;</h3>
            </div>
            <div class="modal-body">
                <div class="contact-form centered">
                    <h3>Вход</h3>
                    <div class="message-area" style="color: #1F2340; margin-bottom: 15px"></div>
                    <form id="contact-form">
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
                        <div  hidden="true"><span class="ajax-loader">&nbsp;</span></div>
                        <div class="control-group">
                            <div class="controls">
                                <?= \yii\helpers\Html::submitButton('Войти', ['class' => 'button'])?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php \yii\widgets\ActiveForm::end(); ?>

</div>