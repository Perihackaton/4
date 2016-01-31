<?php
/**
 * Created by PhpStorm.
 * User: Phantom
 * Date: 24/10/15
 * Time: 03:46
 */
$this->title = "ЖКХакер";

Yii::$app->view->registerJs('
$(document).ready(function(){
    $(".nav li.reports").addClass("active");
});
', \yii\web\View::POS_END, 'change_active');

?>

<div  class="section wrapper-section">
    <div class="triangle"></div>
    <!--Report section start-->
    <div class="container col-lg-12" >
        <ul class="nav nav-pills">
            <li class="filter" data-filter="">
                <a href="#">Выполненные работы</a>
            </li>
            <li class="filter" data-filter="">
                <a href="#">Доходы</a>
            </li>
            <li class="filter" data-filter="">
                <a href="#">Анализ и статистика</a>
            </li>
        </ul>
        <h3 class="centered">Отчет по выполненным работам</h3>
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>№</th>
                <th>Наименование работ</th>
                <th>Общая сумма</th>
                <th>...</th>
            </tr>
            </thead>
            <tbody>
                <?php
                foreach ($report_list as $index => $report) { ?>
                    <tr>
                        <td  width="10px"><?= $index?></td>
                        <td> <?= $workTypes[ $report['work_type'] ]?></td>
                        <td style="text-align:center;"><?=$report['sum']?></td>
                        <td><a href="#" class="btn btn-lg btn-info"
                               data-toggle="modal"  data-target="#tModal">Подробнее</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <!--end Report section-->

    <!--Modal Start-->
    <div class="modal fade" id="tModal">
        <div class="modal-content">
            <div class="modal-header"><button class="close" type="button" data-dismiss="modal">x</button>
                <h4 class="modal-title" id="myModalLabel">Подробнее о проделанных работах</h4>
            </div>
            <div class="modal-body">
                <h3>Работы по обеспечению вывоза бытовых отходов</h3>
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>№</th>
                        <th>Дата сумма</th>
                        <th>Сумма</th>
                        <th>Подробный комментарий</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1</td>
                        <td>30.01.2016</td>
                        <td>1000</td>
                        <td>Комментарий</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer"><button class="btn btn-default" type="button" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
    <!--end Modal Start-->




    <!--Report2 section start-->
    <div class="container col-lg-12" >
        <ul class="nav nav-pills">
            <li class="filter" data-filter="">
                <a href="#">Выполненные работы</a>
            </li>
            <li class="filter" data-filter="">
                <a href="#">Доходы</a>
            </li>
            <li class="filter" data-filter="">
                <a href="#">Анализ и статистика</a>
            </li>
        </ul>
        <h3 class="centered">Доходы</h3>
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>№</th>
                <th>Месяц</th>
                <th>Общая сумма</th>
                <th>Комментарий</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td  width="10px">1</td>
                <td>Январь</a></td>
                <td style="text-align:center;">15000</td>
                <td>Подробный комментарий</td>
            </tr>
            </tbody>
        </table>
    </div>
    <!--end Report2 section-->
</div>
<!-- Footer section start -->

<div class="footer">
    <div class="triangle"></div>
    <p>&copy; 2016 ЖКХакер</p>
</div>