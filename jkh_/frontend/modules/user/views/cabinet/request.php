<?php
/**
 * Created by PhpStorm.
 * User: Phantom
 * Date: 31/01/16
 * Time: 12:13
 */

$this->title = "ЖКХакер";
Yii::$app->view->registerJs('
$(document).ready(function(){
    $(".nav li.request").addClass("active");
});


', \yii\web\View::POS_END, 'change_active');

?>


<div  class="section wrapper-section">
    <div class="triangle"></div>



    <!--Bonus section start-->

    <div class="container">
        <ul class="nav nav-pills">
            <li class="filter" data-filter="">
                <a href="#">Мои заявки</a>
            </li>
            <li class="filter" data-filter="">
                <a href="#" data-toggle="modal" data-target="#basicModal">Подать новую заявку</a>
            </li>
            <li class="filter" data-filter="">
                <a href="#">Архив заявок</a>
            </li>
        </ul>

        <h2 class="centered">Мои заявки</h2>

        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>№</th>
                <th>Дата</th>
                <th>Тема заявки</th>
                <th>Статус заявки</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td  width="10px">1</td>
                <td style="text-align:center;">20.01.2016</td>
                <td>Заявка на замену счетчика</a></td>
                <td>На рассмотрении</td>
            </tr>
            <tr>
                <td  width="10px">2</td>
                <td style="text-align:center;">19.12.2016</td>
                <td>Ремонт лифта</a></td>
                <td>Принято к исполнению</td>
            </tr>
            <tr>
                <td  width="10px">3</td>
                <td style="text-align:center;">19.12.2016</td>
                <td>Ремонт электропроводки</a></td>
                <td>На исполнении</td>
            </tr>
            <tr>
                <td  width="10px">4</td>
                <td style="text-align:center;">15.10.2015</td>
                <td>Смена лампочки</a></td>
                <td>Исполненно</td>
            </tr>
            </tbody>
        </table>
    </div>


    <!-- module section-->

    <div class="modal fade" id="basicModal" tabindex="-1" role="dialog" hidden="hidden">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header"><button class="close" type="button" data-dismiss="modal">x</button>
                    <h4 class="modal-title" id="myModalLabel">Название модального окна</h4>
                </div>
                <div class="modal-body">
                    <h3>Подать заявку</h3>
                    <input class="span5" type="text" placeholder="Тема сообщения" />
                    <textarea class="span5" style="hight:250px;" name="comment" id="comment" placeholder="Детали сообщения"></textarea>
                </div>
                <div class="modal-footer"><button class="btn btn-default" type="button" data-dismiss="modal">Закрыть</button>
                    <button class="btn btn-primary" type="button">Сохранить изменения</button></div>
            </div>
        </div>
    </div>

































</div>























<!-- Footer section start -->

<div class="footer">
    <div class="triangle"></div>
    <p>&copy; 2016 ЖКХакер</p>
</div>
