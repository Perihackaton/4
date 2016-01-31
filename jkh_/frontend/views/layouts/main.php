<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use common\modules\pages\models\Pages;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <!-- Load Roboto font -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <!-- Load css styles -->

    <link rel="stylesheet" type="text/css" href="/frontend/web/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="/frontend/web/css/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" href="/frontend/web/css/style.css" />
    <link rel="stylesheet" type="text/css" href="/frontend/web/css/pluton.css" />
    <!--[if IE 7]>
    <link rel="stylesheet" type="text/css" href="/frontend/web/css/pluton-ie7.css" />
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="/frontend/web/css/jquery.cslider.css" />
    <link rel="stylesheet" type="text/css" href="/frontend/web/css/jquery.bxslider.css" />
    <link rel="stylesheet" type="text/css" href="/frontend/web/css/animate.css" />
    <link rel="icon" href="/favicon.ico?v=2" type="image/x-icon">
    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/frontend/web/images/ico/apple-touch-icon-144.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/frontend/web/images/ico/apple-touch-icon-114.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/frontend/web/images/apple-touch-icon-72.png">
    <link rel="apple-touch-icon-precomposed" href="/frontend/web/images/ico/apple-touch-icon-57.png">
    <?php $this->head() ?>

</head>
<body>
<?php $this->beginBody() ?>

<div class="navbar">
    <div class="navbar-inner">
        <div class="container">
            <a href="/" class="brand">
                <img  src="/frontend/web/images/logo.png" alt="Logo" />
                <!--This is website logo -->
            </a>
            <!-- Navigation button, visible on small resolution -->
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <i class="icon-menu"></i>
            </button>
            <!-- Main navigation -->
            <div class="nav-collapse collapse pull-right">
                <ul class="nav" id="top-navigation">
                    <?php if (Yii::$app->user->isGuest) { ?>
                        <li class="main"><a href="#" role="button" class="button" data-target="#Modal" data-toggle="modal">Личный кабинет</a></li>
                    <?php } else { ?>
                        <li class="main"><a href="/">Главная</a></li>
                        <li class="services"><a href="/user/cabinet/services/">Услуги</a></li>
                        <li class="request"><a href="/user/cabinet/request/">Заявки</a></li>
                        <li class="reports"><a href="/user/cabinet/reports/">Отчеты</a></li>
                        <li class="bonuses"><a href="/user/cabinet/bonnus/">Бонусы</a></li>
                        <li class="info"><a href="/user/cabinet/info/">Информация</a></li>
                        <li class="settings"><a href="/user/cabinet/settings/">Настройки</a></li>
                        <li><a href="/user/default/logout/">Выход</a></li>
                    <?php } ?>
                </ul>
            </div>
            <!-- End main navigation -->

        </div>
    </div>
</div>
<?= $content ?>
<!-- Footer section start -->

<!-- ScrollUp button end -->
<!-- Include javascript -->
<script src="/frontend/web/js/jquery.js"></script>
<script type="text/javascript" src="/frontend/web/js/jquery.mixitup.js"></script>
<script type="text/javascript" src="/frontend/web/js/bootstrap.js"></script>
<script type="text/javascript" src="/frontend/web/js/modernizr.custom.js"></script>
<script type="text/javascript" src="/frontend/web/js/jquery.bxslider.js"></script>
<script type="text/javascript" src="/frontend/web/js/jquery.cslider.js"></script>
<script type="text/javascript" src="/frontend/web/js/jquery.placeholder.js"></script>
<script type="text/javascript" src="/frontend/web/js/jquery.inview.js"></script>
<!-- Load google maps api and call initializeMap function defined in app.js -->
<script async="" defer="" type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&callback=initializeMap"></script>
<!-- css3-mediaqueries.js for IE8 or older -->
<!--[if lt IE 9]>
<script src="/frontend/web/js/respond.min.js"></script>
<![endif]-->
<script type="text/javascript" src="/frontend/web/js/app.js"></script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
