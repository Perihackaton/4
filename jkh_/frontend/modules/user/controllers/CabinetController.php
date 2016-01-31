<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 26.08.14
 * Time: 15:36
 */
namespace frontend\modules\user\controllers;

use app\modules\reports\models\WorkType;
use common\modules\services\models\Services;
use common\modules\user\models\PaymentData;
use common\modules\user\models\PersonalAccount;
use common\modules\user\models\PersonalAccountAddress;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use common\modules\user\models\User;

class CabinetController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'profile', 'change-password', 'history', 'wish-list'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'profile', 'change-password', 'history', 'wish-list'],
                        'roles' => ['@']
                    ]
                ]
            ]
        ];
    }

    public function actionIndex()
    {
        return $this->render('index', [
        ]);
    }

    public function actionReports()
    {
        $workTypes = WorkType::getAllWorkTypes();
        $reportList = \Yii::$app->db->createCommand('SELECT SUM(sum) as sum, work_type FROM report GROUP BY work_type ORDER by id')->queryAll();

        return $this->render('reports', ['reportList' => $reportList, 'workTypes' => $workTypes]);
    }

    public function actionSettings()
    {
        return $this->render('settings', [

        ]);
    }

    public function actionServices()
    {
        if (!\Yii::$app->user->isGuest) {
            $services = [];
            $user = User::findOne(\Yii::$app->user->id);
            $model = false;

            if (empty($user->address)) {
                $show = "address";
                $model = new PersonalAccountAddress();
                $model->user_id = $user->id;
                if ($model->load(\Yii::$app->request->post()) && $model->save()) {
                    $show = "personalAccAdd";
                    $services = Services::find()->all();
                    $model = new PersonalAccount();
                }
            } elseif (empty($user->accs)) {
                $show = "personalAccAdd";
                $services = Services::find()->all();
                $model = new PersonalAccount();

                if (!empty($_POST['acc'])) {
                    $accs = $_POST['acc'];
                    $validate = true;
                    $accounts = [];
                    foreach ($accs as $index => $acc) {
                        if ($acc) {
                            $account[$index] = new PersonalAccount();
                            $account[$index]->value = $acc;
                            $account[$index]->service_id = $index;
                            $account[$index]->user_id = $user->id;
                            $validate = $validate && $account[$index]->validate();
                        }
                    }

                    if ($validate) {
                        foreach ($account as $_account) {
                            $_account->save();
                        }

                        $show = "personalAccShow";
                        $model = PersonalAccount::find()
                            ->where('user_id = :user_id', [':user_id' => $user->id])
                            ->all();
                    }
                }
            } else {
                $show = "personalAccShow";
                $services = PersonalAccount::find()
                    ->where('user_id = :user_id', [':user_id' => $user->id])
                    ->all();
            }
            return $this->render('services', [
                'model' => $model,
                'services' => $services,
                'show' => $show
            ]);
        } else {
            return $this->redirect('/');
        }
    }

    public function actionServiceItem($id)
    {
        $service = Services::findOne($id);
        if ($service && !\Yii::$app->user->isGuest) {
            $user = User::findOne(\Yii::$app->user->id);

            $persAcc = PersonalAccount::find()
                ->where('user_id = :user_id', [':user_id' => $user->id])
                ->andWhere('service_id = :service_id', [':service_id' => $id])
                ->one();

            $history = PaymentData::find()
                ->where('service_id = :service_id', [':service_id' => $id])
                ->andWhere('personal_acc_id = :personal_acc_id', [':personal_acc_id' => $persAcc->id])
                ->all();

            return $this->render('service-item', [
                'service' => $service,
                'history' => $history,
                'persAcc' => $persAcc,
            ]);
        } else {
            return false;
        }
    }
}