<?php

/* @var $this yii\web\View */

$this->title = 'Главная';
?>
<?php \yii\widgets\Pjax::begin([
    'options' => [
        'class' => 'pjax-content',
    ],
    'linkSelector' => '.pagination a'
]);
?>
<?php \yii\widgets\Pjax::end(); ?>
