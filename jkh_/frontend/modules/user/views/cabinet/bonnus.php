<?php
$this->title = "ЖКХакер";

Yii::$app->view->registerJs('
$(document).ready(function(){
    $(".nav li.bonuses").addClass("active");
});

', \yii\web\View::POS_END, 'change_active');

?>


<div  class="section wrapper-section">
    <div class="triangle"></div>

    <!--Bonus section start-->
    <h2 class="centered">Акции и бонусы</h2>
    <div class="container" style="background: #fff; padding-left:10px;">

        <div id="news-section">
            <div class="grid effect-8" id="news-list" data-current-count="10" data-total-count="17" data-url="/ajax/news/more.html" data-section-id="20" data-region="my">
                <div class="b-news action g-clearfix">
                    <div class="b-news-date">
                        <span class="month">янв</span>
                        <span class="day"> 20</span>
                    </div>
                    <div class="b-news-title">
                        <strong>Акция:</strong> Февральские бонусы от ЖКХакер!
                    </div>
                    <div class="b-news-descr">
                        Учавствуйте в акциях, оплачивай услуги и получайте бонусы на счет!
                    </div>
                </div>
                <div class="b-news action g-clearfix">
                    <div class="b-news-date">
                        <span class="month">дек</span>
                        <span class="day">11</span>
                    </div>
                    <div class="b-news-title">
                        <strong>Акция:</strong> Платите платежи вовремя и получайте бонусы на счет!</a>
                    </div>
                    <div class="b-news-descr">
                        Срок действия акции с 15 декабря 2015 г. по 15 января 2015 г.
                    </div>
                </div>
                <div class="b-news action g-clearfix">
                    <div class="b-news-date">
                        <span class="month">дек</span>
                        <span class="day"> 7</span>
                    </div>
                    <div class="b-news-title">
                        <strong>Акция:</strong> МУП "Водоконал" проводит акцию - погаси задолженности и участвуй в розыгрыше ценных призов</a>
                    </div>
                    <div class="b-news-descr">
                        Срок действия акции до 31 декабря 2015 г.
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