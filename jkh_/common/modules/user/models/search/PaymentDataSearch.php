<?php

namespace common\modules\user\models\search;

use common\modules\user\models\PaymentData;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\user\models\UserRole;

/**
 * UserRoleSearch represents the model behind the search form about `common\modules\user\models\UserRole`.
 */
class PaymentDataSearch extends PaymentData
{
    public function rules()
    {
        return [
            [['id', 'service_id', 'personal_acc_id'], 'integer'],
            [['kvit_date', 'dept_end', 'dept_begin', 'paid', 'enrolled'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = PaymentData::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'service_id' => $this->service_id,
            'personal_acc_id' => $this->personal_acc_id,
        ]);

        $query->andFilterWhere(['like', 'kvit_date', $this->kvit_date])
            ->andFilterWhere(['like', 'dept_end', $this->dept_end])
            ->andFilterWhere(['like', 'dept_begin', $this->dept_begin])
            ->andFilterWhere(['like', 'paid', $this->paid])
            ->andFilterWhere(['like', 'enrolled', $this->enrolled]);

        return $dataProvider;
    }
}
