<?php

namespace common\modules\user\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\user\models\UserRole;

/**
 * UserRoleSearch represents the model behind the search form about `common\modules\user\models\UserRole`.
 */
class UserRoleSearch extends UserRole
{
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = UserRole::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
