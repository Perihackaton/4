<?php

Yii::$app->view->registerJs('
$(document).ready(function(){
    $(".nav li.services").addClass("active");
});
', \yii\web\View::POS_END, 'change_active');
setlocale(LC_TIME, 'ru_RU');
?>

<div  class="section wrapper-section">
    <div class="triangle"></div>

    <!-- history panel start -->

    <div class="container centered">
        <h3 class="centered"><?= $service->name?></h3>

        <table class="table table-bordered table-striped">
            <tr>
                <th>Показания счетчика</th>
            </tr>
            <tr>
                <td>
                    <input type="text" class="form-control span6" style="padding: 13px 36px;" placeholder="Введите показания счетчика">
                    <button class="button">Подтвердить</button>
                    <p style="color:#3c3c3c">Текущий тариф: <?= $service->tariff?><?=$service->tariff_measure?>.</p></td>
            </tr>
        </table>
        <br>
        <?php foreach ($history as $payment) { ?>
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th><?= strftime("%d %B %Y", $payment->kvit_date)?></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <ul class="unstyled">
                            <li>Задолженность на конец месяца:    <?= !empty($payment->dept_end) ? $payment->dept_end : 0 ?></li>
                            <li>Начислено:                        <?= !empty($payment->paid) ? $payment->paid : 0 ?></li>
                            <li>Оплачено:                         <?= !empty($payment->enrolled) ? $payment->enrolled : 0 ?></li>
                            <li>Задолженность на начало месяца:   <?= !empty($payment->dept_begin) ? $payment->dept_begin : 0 ?></li>
                        </ul>
                    </td>
                </tr>
                </tbody>
            </table>
        <?php } ?>

        <hr/>


        <table class="table table-bordered table-striped">
            <tr>
                <td>
                    <input type="radio" name="check" value="Оплата по долгу" checked> Оплата по долгу
                </td>
                <td style="color:red">
                    <?= $persAcc->dept ?> р.
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" name="check" value="Ввод суммы" >  Ввод суммы
                </td>
                <td>
                    <input type="text" name="check" placeholder="Введите сумму">
                </td>
            </tr>
        </table>
        <br>
        <button type="submit" style="margin:0 auto" class="button span6 centered">Оплатить</button>
    </div>

    <!-- end history panel-->




</div>

<!-- Footer section start -->

<div class="footer">
    <div class="triangle"></div>
    <p>&copy; 2016 ЖКХакер</p>
</div>