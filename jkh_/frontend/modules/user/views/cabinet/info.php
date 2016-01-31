<?php
/**
 * Created by PhpStorm.
 * User: Phantom
 * Date: 31/01/16
 * Time: 12:16
 */

Yii::$app->view->registerJs('
$(document).ready(function(){
    $(".nav li.info").addClass("active");
});

', \yii\web\View::POS_END, 'change_active');

?>

<div  class="section wrapper-section">
    <div class="triangle"></div>



    <!--Bonus section start-->
    <h2 class="centered">Оповещения и уведомления</h2>
    <div class="container" style="background: #fff; padding-left:10px;">

        <div id="news-section">
            <div class="grid effect-8" id="news-list" data-current-count="10" data-total-count="17" data-url="/ajax/news/more.html" data-section-id="20" data-region="my">
                <div class="b-news action g-clearfix">
                    <div class="b-news-date">
                        <span class="month">янв</span>
                        <span class="day"> 20</span>
                    </div>
                    <div class="b-news-title">
                        Отключение воды!
                    </div>
                    <div class="b-news-descr">
                        В связи с ремонтными работами 23 января с 13.00 до 15.00 будет отключена подача воды.
                    </div>
                </div>
                <div class="b-news action g-clearfix">
                    <div class="b-news-date">
                        <span class="month">дек</span>
                        <span class="day">11</span>
                    </div>
                    <div class="b-news-title">
                        Повышение тарифов!</a>
                    </div>
                    <div class="b-news-descr">
                        С 1 января 2015 года будут повышены тарифы на коммунальные услуги.
                    </div>
                </div>
                <div class="b-news action g-clearfix">
                    <div class="b-news-date">
                        <span class="month">дек</span>
                        <span class="day">11</span>
                    </div>
                    <div class="b-news-title">
                        Просрочка по платежам!</a>
                    </div>
                    <div class="b-news-descr">
                        У вас просрочка по платежам за газ. Со следующего месяца будет начисляться пеня.
                    </div>
                </div>
                <div class="b-news action g-clearfix">
                    <div class="b-news-date">
                        <span class="month">дек</span>
                        <span class="day"> 7</span>
                    </div>
                    <div class="b-news-title">
                        <strong>МЧС предупреждает!</strong>
                    </div>
                    <div class="b-news-descr">
                        C 10 по 11 декабря штормовое предупреждения!
                    </div>

                </div>


            </div>

        </div>
    </div>

    <!-- end bonus section-->


































</div>























<!-- Footer section start -->

<div class="footer">
    <div class="triangle"></div>
    <p>&copy; 2016 ЖКХакер</p>
</div>
