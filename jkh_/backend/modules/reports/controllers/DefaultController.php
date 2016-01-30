<?php

    namespace backend\modules\reports\controllers;

    use app\modules\reports\models\Report;
    use app\modules\reports\models\ReportOnMoney;
    use app\modules\reports\models\WorkType;
    use yii\web\Controller;

    class DefaultController extends Controller {

        public function actionViewReports() {
            $workTypes = WorkType::getAllWorkTypes();
            $reportList = \Yii::$app->db->createCommand('SELECT SUM(sum) as sum, work_type FROM report GROUP BY work_type ORDER by id')->queryAll();
            return $this->render('view-report', ['reportList' => $reportList, 'workTypes' => $workTypes]);
        }

        public function actionViewReportsOnMoney() {
            $reportList = ReportOnMoney::find()->all();
            return $this->render('view-report-on-money', ['reportList' => $reportList]);
        }

        public function actionViewAllInfoOfReport($id) {
            $workType = WorkType::getAllWorkTypes()[ $id ];
            $reportList = Report::find()->where(['work_type' => $id])->all();
            return $this->render('view-all-info-of-report', ['reportList' => $reportList, 'workType' => $workType]);
        }
    }