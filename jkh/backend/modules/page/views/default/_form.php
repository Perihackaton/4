<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\page\models\Page */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?=
    $form->field($model, 'text', [
        'template' => '
                {label}
                <div class="textarea-content">{input}</div>
                {error}
            '
    ])->widget(sim2github\imperavi\widgets\Redactor::className(), [
        'options' => [
            'debug' => 'true',
        ],
        'clientOptions' => [ // [More about settings](http://imperavi.com/redactor/docs/settings/)
            'convertImageLinks' => 'true',
            'convertVideoLinks' => 'true',
            'buttonSource' => true,
            //'wym' => 'true',
            //'air' => 'true',
            'linkEmail' => 'true', //By default
            'lang' => 'ru',
            'tidyHtml' => true,
            'allowedTags' => ['br', 'p', 'blockquote', 'b', 'strong', 'i', 'ul', 'li', 'ol', 'a', 'div', 'span', 'bold', 'table', 'tr', 'td', 'thead', 'tbody', 'tfoot', 'img', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'],
            'phpTags' => true,
            'pastePlainText' => false,
            'replaceDivs' => false,
            'paragraphy' => false,
            'convertDivs' => false,
            'deniedTags' => false,
            'fileUpload' => '/products/index.php',
            'imageGetJson' =>  \Yii::getAlias('@web').'/redactor/upload/imagejson', //By default
            'plugins' => [ // [More about plugins](http://imperavi.com/redactor/plugins/)
                'ace',
                'clips',
                'fontsize',
                'fullscreen'
            ]
        ],
    ]) ?>

    <?=
    $form->field($model, 'small_text', [
        'template' => '
                {label}
                <div class="textarea-content">{input}</div>
                {error}
            '
    ])->widget(sim2github\imperavi\widgets\Redactor::className(), [
        'options' => [
            'debug' => 'true',
        ],
        'clientOptions' => [ // [More about settings](http://imperavi.com/redactor/docs/settings/)
            'convertImageLinks' => 'true',
            'convertVideoLinks' => 'true',
            'buttonSource' => true,
            //'wym' => 'true',
            //'air' => 'true',
            'linkEmail' => 'true', //By default
            'lang' => 'ru',
            'tidyHtml' => true,
            'allowedTags' => ['br', 'p', 'blockquote', 'b', 'strong', 'i', 'ul', 'li', 'ol', 'a', 'div', 'span', 'bold', 'table', 'tr', 'td', 'thead', 'tbody', 'tfoot', 'img', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'],
            'phpTags' => true,
            'pastePlainText' => false,
            'replaceDivs' => false,
            'paragraphy' => false,
            'convertDivs' => false,
            'deniedTags' => false,
            'fileUpload' => '/products/index.php',
            'imageGetJson' =>  \Yii::getAlias('@web').'/redactor/upload/imagejson', //By default
            'plugins' => [ // [More about plugins](http://imperavi.com/redactor/plugins/)
                'ace',
                'clips',
                'fontsize',
                'fullscreen'
            ]
        ],
    ]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
