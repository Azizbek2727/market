<?php

namespace common\models\search;

use yii\data\ActiveDataProvider;
use common\models\SourceMessage;

class SourceMessageSearch extends SourceMessage
{
    public $q;

    public function rules()
    {
        return [['q', 'safe']];
    }

    public function search($params)
    {
        $query = SourceMessage::find()->with('messages');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 20],
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
        ]);

        $this->load($params);

        if ($this->q) {
            $query->andFilterWhere(['like', 'message', $this->q]);
        }

        return $dataProvider;
    }
}
