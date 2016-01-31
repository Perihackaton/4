<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 26.08.14
 * Time: 15:40
 */

Yii::$app->view->registerJs('
$(document).ready(function(){
    $(".nav li.cabinet").addClass("active");
});
', \yii\web\View::POS_END, 'change_active');

?>
<div  class="section wrapper-section">
    <div class="triangle"></div>

    <!--Addinfo section start-->
    <div class="container centered">
        <form role="form" class="centered">
            <legend>Введите дополнительную информацию</legend>
            <div class="form-group span6 centered">
                <input type="text" class="form-control span6" style="padding: 13px 36px;" placeholder="Введите город">
                <input type="text" class="form-control span6" style="padding: 13px 36px;" placeholder="Введите адрес">
                <input type="text" class="span6" style="padding: 13px 36px;" placeholder="Дом">
                <input type="text" class="span6" style="padding: 13px 36px;" placeholder="Корпус">
                <input type="text" class="span6" style="padding: 13px 36px;" placeholder="Квартира">
                <button type="submit" style="margin-left:30px;" class="button span6 centered">Отправить</button>
            </div>
        </form>
    </div>
    <!--end addinfo section-->

    <!-- Addchek Section  start -->
    <div class="container centered">
        <h3>Введите лицевые счета</h3>
        <table class="table table-bordered table-striped">
            <tbody>
            <tr>
                <td  width="25px"><img src="/frontend/web/images/ico/gas.png" width="20px"></td>
                <td><a href="#">Газ</a></td>
                <td width="70px"><input type="text" placeholder="Введите лицевой счет"></td>
            </tr>
            <tr>
                <td><img src="/frontend/web/images/ico/water.png" width="20px"></td>
                <td><a href="#">Вода холодная</a></td>
                <td><input type="text"></td>
            </tr>
            <tr>
                <td><img src="/frontend/web/images/ico/hotwater.png" width="20px"></td>
                <td><a href="#">Вода горячая</a></td>
                <td><input type="text"></td>
            </tr>
            <tr>
                <td><img src="/frontend/web/images/ico/shine.png" width="20px"></td>
                <td><a href="#">Электроэнергия</a></td>
                <td><input type="text"></td>
            </tr>
            <tr>
                <td><img src="/frontend/web/images/ico/heating.png" width="20px"></td>
                <td><a href="#">Отопление</a></td>
                <td><input type="text"></td>    </tr>
            <tr>
                <td><img src="/frontend/web/images/ico/repairs.png" width="20px"></td>
                <td><a href="#">Капитальный ремонт</a></td>
                <td><input type="text"></td>    </tr>
            <tr>
                <td><img src="/frontend/web/images/ico/garbage.png" width="20px"></td>
                <td><a href="#">ТБО</a></td>
                <td><input type="text"></td>    </tr>
            <tr>
                <td><img src="/frontend/web/images/ico/sewerage.png" width="20px"></td>
                <td><a href="#">Канализация</a></td>
                <td><input type="text"></td>    </tr>
            <tr>
                <td><img src="/frontend/web/images/ico/maintenance.png" width="20px"></td>
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


    <!-- Section Service start -->
    <div class="container">
        <h3 class="centered">Начисления</h3>
        <table class="table table-bordered table-striped">

            <tbody>
            <tr>
                <td  width="25px"><img src="/frontend/web/images/ico/gas.png" width="20px"></td>
                <td><a href="#">Газ</a></td>
                <td style="color: red; font-weight: bold; text-align:center" width="100px">3120,53</td>
            </tr>
            <tr>
                <td><img src="/frontend/web/images/ico/water.png" width="20px"></td>
                <td><a href="#">Вода холодная</a></td>
                <td style="color: red; font-weight: bold; text-align:center" >2340,67</td>
            </tr>
            <tr>
                <td><img src="/frontend/web/images/ico/hotwater.png" width="20px"></td>
                <td><a href="#">Вода горячая</a></td>
                <td style="color: red; font-weight: bold; text-align:center">1250,78</td>
            </tr>
            <tr>
                <td><img src="/frontend/web/images/ico/shine.png" width="20px"></td>
                <td><a href="#">Электроэнергия</a></td>
                <td style="color: #F89406; font-weight: bold; text-align:center">985.12</td>
            </tr>
            <tr>
                <td><img src="/frontend/web/images/ico/heating.png" width="20px"></td>
                <td><a href="#">Отопление</a></td>
                <td style="color: #F89406; font-weight: bold; text-align:center" >624,55</td>
            </tr>
            <tr>
                <td><img src="/frontend/web/images/ico/repairs.png" width="20px"></td>
                <td><a href="#">Капитальный ремонт</a></td>
                <td style="color: #F89406; font-weight: bold; text-align:center">598,12</td>
            </tr>
            <tr>
                <td><img src="/frontend/web/images/ico/garbage.png" width="20px"></td>
                <td><a href="#">ТБО</a></td>
                <td style="color: green; font-weight: bold; text-align:center">312,10</td>
            </tr>
            <tr>
                <td><img src="/frontend/web/images/ico/sewerage.png" width="20px"></td>
                <td><a href="#">Канализация</a></td>
                <td style="color: green; font-weight: bold; text-align:center">210,50</td>
            </tr>
            <tr>
                <td><img src="/frontend/web/images/ico/maintenance.png" width="20px"></td>
                <td><a href="#">Техобслуживание</a></td>
                <td style="color: green; font-weight: bold; text-align:center">125,50</td>
            </tr>
            </tbody>
        </table>
    </div>
    <!-- end section service-->


    <!-- Addchek Section  start -->
    <div class="container centered">
        <h3>Введите лицевые счета</h3>
        <table class="table table-bordered table-striped">
            <tbody>
            <tr>
                <td  width="25px"><img src="/frontend/web/images/ico/gas.png" width="20px"></td>
                <td><a href="#">Газ</a></td>
                <td width="70px"><input type="text" placeholder="Введите лицевой счет"></td>
            </tr>
            <tr>
                <td><img src="/frontend/web/images/ico/water.png" width="20px"></td>
                <td><a href="#">Вода холодная</a></td>
                <td><input type="text"></td>
            </tr>
            <tr>
                <td><img src="/frontend/web/images/ico/hotwater.png" width="20px"></td>
                <td><a href="#">Вода горячая</a></td>
                <td><input type="text"></td>
            </tr>
            <tr>
                <td><img src="/frontend/web/images/ico/shine.png" width="20px"></td>
                <td><a href="#">Электроэнергия</a></td>
                <td><input type="text"></td>
            </tr>
            <tr>
                <td><img src="/frontend/web/images/ico/heating.png" width="20px"></td>
                <td><a href="#">Отопление</a></td>
                <td><input type="text"></td>    </tr>
            <tr>
                <td><img src="/frontend/web/images/ico/repairs.png" width="20px"></td>
                <td><a href="#">Капитальный ремонт</a></td>
                <td><input type="text"></td>    </tr>
            <tr>
                <td><img src="/frontend/web/images/ico/garbage.png" width="20px"></td>
                <td><a href="#">ТБО</a></td>
                <td><input type="text"></td>    </tr>
            <tr>
                <td><img src="/frontend/web/images/ico/sewerage.png" width="20px"></td>
                <td><a href="#">Канализация</a></td>
                <td><input type="text"></td>    </tr>
            <tr>
                <td><img src="/frontend/web/images/ico/maintenance.png" width="20px"></td>
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


    <!-- Section Service start -->
    <div class="container">
        <h3 class="centered">Начисления</h3>
        <table class="table table-bordered table-striped">

            <tbody>
            <tr>
                <td  width="25px"><img src="/frontend/web/images/ico/gas.png" width="20px"></td>
                <td><a href="#">Газ</a></td>
                <td style="color: red; font-weight: bold; text-align:center" width="100px">3120,53</td>
            </tr>
            <tr>
                <td><img src="/frontend/web/images/ico/water.png" width="20px"></td>
                <td><a href="#">Вода холодная</a></td>
                <td style="color: red; font-weight: bold; text-align:center" >2340,67</td>
            </tr>
            <tr>
                <td><img src="/frontend/web/images/ico/hotwater.png" width="20px"></td>
                <td><a href="#">Вода горячая</a></td>
                <td style="color: red; font-weight: bold; text-align:center">1250,78</td>
            </tr>
            <tr>
                <td><img src="/frontend/web/images/ico/shine.png" width="20px"></td>
                <td><a href="#">Электроэнергия</a></td>
                <td style="color: #F89406; font-weight: bold; text-align:center">985.12</td>
            </tr>
            <tr>
                <td><img src="/frontend/web/images/ico/heating.png" width="20px"></td>
                <td><a href="#">Отопление</a></td>
                <td style="color: #F89406; font-weight: bold; text-align:center" >624,55</td>
            </tr>
            <tr>
                <td><img src="/frontend/web/images/ico/repairs.png" width="20px"></td>
                <td><a href="#">Капитальный ремонт</a></td>
                <td style="color: #F89406; font-weight: bold; text-align:center">598,12</td>
            </tr>
            <tr>
                <td><img src="/frontend/web/images/ico/garbage.png" width="20px"></td>
                <td><a href="#">ТБО</a></td>
                <td style="color: green; font-weight: bold; text-align:center">312,10</td>
            </tr>
            <tr>
                <td><img src="/frontend/web/images/ico/sewerage.png" width="20px"></td>
                <td><a href="#">Канализация</a></td>
                <td style="color: green; font-weight: bold; text-align:center">210,50</td>
            </tr>
            <tr>
                <td><img src="/frontend/web/images/ico/maintenance.png" width="20px"></td>
                <td><a href="#">Техобслуживание</a></td>
                <td style="color: green; font-weight: bold; text-align:center">125,50</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- end section service-->

<div class="footer">
    <div class="triangle"></div>
    <p>&copy; 2016 ЖКХакер</p>
</div>