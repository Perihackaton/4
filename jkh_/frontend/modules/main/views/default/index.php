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
    $(".nav li.main").addClass("active");
});
', \yii\web\View::POS_END, 'change_active');

?>

<!-- Start home section -->
<div id="home">
    <!-- Start cSlider -->
    <div id="da-slider" class="da-slider">
        <div class="triangle"></div>
        <!-- mask elemet use for masking background image -->
        <div class="mask"></div>
        <!-- All slides centred in container element -->
        <div class="container">
            <!-- Start first slide -->
            <div class="da-slide">
                <h2 class="fittext2">Счета за квартиру</h2>
                <p>Получайте уведомления о выставленных счетах за коммунальные услуги и платите в несколько кликов в вашем личном кабинете</p>
                <div class="da-img">
                    <img src="/frontend/web/images/1.png" width="320" alt="image02">
                </div>
            </div>
            <!-- End first slide -->
            <!-- Start second slide -->
            <div class="da-slide">
                <h2>Оплачивайте все услуги в одном месте</h2>
                <p>Круглосуточная оплата всех коммунальных платежей в одном месте через личный кабинет</p>
                <div class="da-img">
                    <img src="/frontend/web/images/2.png" width="320" alt="image02">
                </div>
            </div>
            <!-- End second slide -->
            <!-- Start third slide -->
            <div class="da-slide">
                <h2>Акции и бонусы</h2>
                <p>Оплачивайте услуги вовремя и получайте бонусы на счет</p>
                <div class="da-img">
                    <img src="/frontend/web/images/1.png" width="320" alt="image02">
                </div>
            </div>
            <!-- Start third slide -->
            <!-- Start cSlide navigation arrows -->
            <div class="da-arrows">
                <span class="da-arrows-prev"></span>
                <span class="da-arrows-next"></span>
            </div>
            <!-- End cSlide navigation arrows -->
        </div>
    </div>
</div>
<!-- End home section -->

<!-- Service section start -->
<div class="section primary-section" id="service">
    <div class="container">
        <!-- Start title section -->
        <div class="title">
            <h1>Наши преимущества</h1>
            <!-- Section's title goes here -->
            <p>Следите за новыми счетами в личном кабинете и платите в удобное для вас время</p>
            <!--Simple description for section goes here. -->
        </div>
        <div class="row-fluid">
            <div class="span4">
                <div class="centered service">
                    <div class="circle-border zoom-in">
                        <img class="img-circle" src="/frontend/web/images/Service1.png" alt="service 1">
                    </div>
                    <h3>Удобно</h3>
                    <p>Оплачивайте услуги ЖКХ через личный кабинет в любое время из любой точки мира.</p>
                </div>
            </div>
            <div class="span4">
                <div class="centered service">
                    <div class="circle-border zoom-in">
                        <img class="img-circle" src="/frontend/web/images/Service2.png" alt="service 2" />
                    </div>
                    <h3>Быстро</h3>
                    <p>Платежи зачисляются в режиме реального времени</p>
                </div>
            </div>
            <div class="span4">
                <div class="centered service">
                    <div class="circle-border zoom-in">
                        <img class="img-circle" src="/frontend/web/images/Service3.png" alt="service 3">
                    </div>
                    <h3>Выгодно</h3>
                    <p>Платите вовремя и получайте</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Service section end -->


<!-- About section start -->
<div class="section wrapper-section">
    <div class="triangle"></div>
    <div class="container centered">
        <p class="large-text">ЖКХ позволит вам сэкономить время на регулярных платежах за воду, свет, отопление, участвовать в бонусной программе и многое другое..</p>
        <?php if (Yii::$app->user->isGuest) { ?>
            <a href="#m" role="button" class="button" data-toggle="modal" data-target="#myModal">Зарегистрироваться</a>
        <?php } ?>
    </div>
</div>
<!-- About section end -->
<?php if (Yii::$app->user->isGuest) { ?>
    <?= \frontend\modules\main\widget\UserRegister::widget()?>
<?php } ?>

<!-- Enter modal section start -->
<?php if (Yii::$app->user->isGuest) { ?>
    <?= \frontend\modules\main\widget\UserLogin::widget()?>
<?php } ?>

<!-- Enter modal section end -->
<!-- Register modal section end -->
<div class="footer">
    <div class="triangle"></div>
    <p>&copy; 2016 ЖКХакер</p>
</div>
<!-- Footer section end -->
<!-- ScrollUp button start -->
<div class="scrollup">
    <a href="#">
        <i class="icon-up-open"></i>
    </a>
</div>