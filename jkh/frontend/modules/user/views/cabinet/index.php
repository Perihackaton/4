<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 26.08.14
 * Time: 15:40
 */
$this->params['breadcrumbs'] = [
    ['label' => 'Кабинет пользователя', 'url' => null],
];

?>
<div class="row no-padding-no-margin user-cabinet content-block-top-shadow" style="background-color: #fff">
    <div class="align-center">
        <div class="row no-padding-no-margin">

            <div class="col-lg-9 no-padding-no-margin">
                <div style="font-size: 12px;">
                    <?=
                    \yii\widgets\Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        'encodeLabels' => false
                    ]) ?>
                </div>
                <h1>Личный кабинет пользователя - <span><?= \common\modules\user\models\User::getUserName() ?></span>
                </h1>


            </div>
            <div class="col-lg-3 no-padding-no-margin">
                <span class="title">Настройки профиля</span>
                <ul class="menu-list-white">
                </ul>
                <span class="title">Ваши заказы</span>
                <ul class="menu-list-white">
                </ul>

            </div>
        </div>
    </div>
</div>