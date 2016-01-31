<?php
/**
 * Created by PhpStorm.
 * User: Phantom
 * Date: 31/01/16
 * Time: 08:41
 */

Yii::$app->view->registerJs('
$(document).ready(function(){
    $(".nav li.settings").addClass("active");
});
', \yii\web\View::POS_END, 'change_active');

?>

<div  class="section wrapper-section">
    <div class="triangle"></div>



    <!--Report section start-->
    <div class="container col-lg-12" >
        <ul class="nav nav-pills">
            <li class="filter" data-filter="">
                <a href="#">Профиль</a>
            </li>
            <li class="filter" data-filter="">
                <a href="#">Лицевой счет</a>
            </li>
        </ul>
        <form role="form" class="centered">
            <legend>Изменить данные профиля</legend>
            <div class="form-group span6 centered">
                <input type="text" class="form-control span6" style="padding: 13px 36px;" placeholder="Фамилия">
                <input type="text" class="form-control span6" style="padding: 13px 36px;" placeholder="Имя">
                <input type="text" class="form-control span6" style="padding: 13px 36px;" placeholder="Отчество">
                <input type="text" class="form-control span6" style="padding: 13px 36px;" placeholder="Город">
                <input type="text" class="form-control span6" style="padding: 13px 36px;" placeholder="Адрес">
                <input type="text" class="span6" style="padding: 13px 36px;" placeholder="Дом">
                <input type="text" class="span6" style="padding: 13px 36px;" placeholder="Корпус">
                <input type="text" class="span6" style="padding: 13px 36px;" placeholder="Квартира">
                <button type="submit" style="margin-left:30px;" class="button span6 centered">Изменить</button>
            </div>
        </form>
    </div>
    <!--end addinfo section-->






    <!-- Addchek Section  start -->
    <div class="container centered">
        <ul class="nav nav-pills">
            <li class="filter" data-filter="">
                <a href="#">Профиль</a>
            </li>
            <li class="filter" data-filter="">
                <a href="#">Лицевой счет</a>
            </li>
        </ul>
        <h3>Введите лицевые счета</h3>
        <table class="table table-bordered table-striped">
            <tbody>
            <tr>
                <td  width="25px"><img src="images/ico/gas.png" width="20px"></td>
                <td><a href="#">Газ</a></td>
                <td width="70px"><input type="text" placeholder="Введите лицевой счет"></td>
            </tr>
            <tr>
                <td><img src="images/ico/water.png" width="20px"></td>
                <td><a href="#">Вода холодная</a></td>
                <td><input type="text"></td>
            </tr>
            <tr>
                <td><img src="images/ico/hotwater.png" width="20px"></td>
                <td><a href="#">Вода горячая</a></td>
                <td><input type="text"></td>
            </tr>
            <tr>
                <td><img src="images/ico/shine.png" width="20px"></td>
                <td><a href="#">Электроэнергия</a></td>
                <td><input type="text"></td>
            </tr>
            <tr>
                <td><img src="images/ico/heating.png" width="20px"></td>
                <td><a href="#">Отопление</a></td>
                <td><input type="text"></td>    </tr>
            <tr>
                <td><img src="images/ico/repairs.png" width="20px"></td>
                <td><a href="#">Капитальный ремонт</a></td>
                <td><input type="text"></td>    </tr>
            <tr>
                <td><img src="images/ico/garbage.png" width="20px"></td>
                <td><a href="#">ТБО</a></td>
                <td><input type="text"></td>    </tr>
            <tr>
                <td><img src="images/ico/sewerage.png" width="20px"></td>
                <td><a href="#">Канализация</a></td>
                <td><input type="text"></td>    </tr>
            <tr>
                <td><img src="images/ico/maintenance.png" width="20px"></td>
                <td><a href="#">Техобслуживание</a></td>
                <td><input type="text"></td>
            </tr>
            </tbody>
        </table>
        <br>
        <button type="submit" class="button span5 centered">Отправить</button>
        <br>
    </div>
    <!-- end addchek section-->
</div>

<!-- Footer section start -->

<div class="footer">
    <div class="triangle"></div>
    <p>&copy; 2016 ЖКХакер</p>
</div>
