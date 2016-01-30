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
<<<<<<< HEAD
        return $this->render('index', [
        ]);
    }
=======
        if (\Yii::$app->request->isAjax) {
            $html = GetCategoriesOrObjects::widget();

            return Json::encode(["html" => $html]);
        }
            $query = ObjectCategory::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10
            ]
        ]);


        $objects = Object::find()->all();

        $startGeoPoint = [42.97968768, 47.46996287, 'previousOpenOrg' => -1];

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'objects' => $objects,
            'startGeoPoint' => $startGeoPoint,
        ]);
    }

    public function actionGetCatItems($cat_id)
    {
        if (\Yii::$app->request->isAjax) {
            $query = Object::find()
                ->where("category_id = :category_id", [":category_id" => $cat_id]);

            $dataProvider = new ActiveDataProvider([
               'query' => $query,
                'pagination' => [
                    'pageSize' => 10
                ]
            ]);

            $html = GetCategoriesOrObjects::widget([
                'cat_id' => $cat_id,
            ]);

            return Json::encode(["html" => $html]);
        } else {
            return false;
        }
    }
>>>>>>> 973ddbada339ac5d76742a02c05580fa91223f68
}
