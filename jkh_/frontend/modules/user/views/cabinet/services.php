<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 26.08.14
 * Time: 15:40
 */

Yii::$app->view->registerJs('
$(document).ready(function(){
    $(".nav li.services").addClass("active");
});
', \yii\web\View::POS_END, 'change_active');

?>
<div  class="section wrapper-section">
    <div class="triangle"></div>

    <?php switch ($show) {
        case "address": ?>

            <!--Addinfo section start-->
            <div class="container centered">
                <?php $form = \yii\widgets\ActiveForm::begin([
                    'options' => [
                        'enableClientValidation' => true,
                        'novalidate' => "novalidate",
                        'data-validate' => "parsley",
                    ]
                ]); ?>
                    <legend>Введите дополнительную информацию</legend>
                    <div class="form-group span6 centered">
                        <?= $form->field($model, "city")->textInput(['placeholder' => 'Город', 'class' => 'form-control span6', 'style' => 'padding:13px 36px;'])->label(false)?>
                        <?= $form->field($model, "street")->textInput(['placeholder' => 'Улица', 'class' => 'form-control span6', 'style' => 'padding:13px 36px;'])->label(false)?>
                        <?= $form->field($model, "house")->textInput(['placeholder' => 'Дом', 'class' => 'span6', 'style' => 'padding:13px 36px;'])->label(false)?>
                        <?= $form->field($model, "building")->textInput(['placeholder' => 'Корпус', 'class' => 'span6', 'style' => 'padding:13px 36px;'])->label(false)?>
                        <?= $form->field($model, "flat_number")->textInput(['placeholder' => 'Квартира', 'class' => 'span6', 'style' => 'padding:13px 36px;'])->label(false)?>

                        <?= \yii\helpers\Html::submitButton('Отправить', ['style' => 'margin-left:30px;', 'class' => 'button span6 centered'])?>
                    </div>

            <?php \yii\widgets\ActiveForm::end() ?>
            </div>
            <!--end addinfo section-->

            <?php
            break;
        case "personalAccAdd": ?>

            <!-- Addchek Section  start -->
            <div class="container centered">
                <h3>Введите лицевые счета</h3>
                    <?php $form = \yii\widgets\ActiveForm::begin([
                        'options' => [
                            'enableClientValidation' => true,
                            'novalidate' => "novalidate",
                            'data-validate' => "parsley",
                        ]
                    ]); ?>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <?php foreach($services as $service) { ?>
                                    <tr>
                                        <td  width="25px"><img src="/frontend/web/images/ico/<?= $service->id?>.png" width="20px"></td>
                                        <td><?= $service->name?></td>
                                        <td width="70px">
                                            <input type="text" name="acc[<?= $service->id?>]" placeholder="Введите лицевой счет">
                                        </td>
                                    </tr>
                                <?php }?>
                            </tbody>
                        </table>
                        <br>
                        <?= \yii\helpers\Html::submitButton('Отправить', ['style' => 'margin-left:30px;', 'class' => 'button span6 centered'])?>
                    <?php \yii\widgets\ActiveForm::end()?>
                <br>
            </div>
            <!-- end addchek section-->

            <?php
            break;
        case "personalAccShow": ?>

            <!-- Section Service start -->
            <div class="container">
                <h3 class="centered">Начисления</h3>
                <table class="table table-bordered table-striped">

                    <tbody>
                    <?php foreach ($services as $index => $service) { ?>
                        <tr>
                            <td  width="25px"><img src="/frontend/web/images/ico/<?= $service->service->id?>.png" width="20px"></td>
                            <td><a href="/user/cabinet/service-item/?id=<?= $service->service->id?>"><?= $service->service->name ?></a></td>
                            <td style="color: red; font-weight: bold; text-align:center" width="100px"><?= $service->dept?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
            <!-- end section service-->

            <?php
            break;
    }?>

</div>

<!-- end section service-->

<div class="footer">
    <div class="triangle"></div>
    <p>&copy; 2016 ЖКХакер</p>
</div>