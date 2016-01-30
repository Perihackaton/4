<?php

namespace frontend\modules\main\controllers;

use common\modules\object\models\Object;
use common\modules\object\models\ObjectCategory;
use frontend\modules\main\widget\GetCategoriesOrObjects;
use yii\data\ActiveDataProvider;
use yii\helpers\Json;
use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index', [
        ]);
    }
}
