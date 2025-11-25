<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Transactions;

/**
 * TransactionsSearch represents the model behind the search form of `app\models\Transactions`.
 */
class TransactionsSearch extends Transactions
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'product_id', 'sum', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['transaction_id', 'octo_uuid', 'currency', 'description', 'status', 'signature', 'hash_key', 'card_country', 'maskedPan', 'rrn', 'payed_time', 'card_type', 'is_physical_card'], 'safe'],
            [['total_sum', 'transfer_sum', 'refunded_sum'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     * @param string|null $formName Form name to be used into `->load()` method.
     *
     * @return ActiveDataProvider
     */
    public function search($params, $formName = null)
    {
        $query = Transactions::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'product_id' => $this->product_id,
            'sum' => $this->sum,
            'total_sum' => $this->total_sum,
            'transfer_sum' => $this->transfer_sum,
            'refunded_sum' => $this->refunded_sum,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'transaction_id', $this->transaction_id])
            ->andFilterWhere(['like', 'octo_uuid', $this->octo_uuid])
            ->andFilterWhere(['like', 'currency', $this->currency])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'signature', $this->signature])
            ->andFilterWhere(['like', 'hash_key', $this->hash_key])
            ->andFilterWhere(['like', 'card_country', $this->card_country])
            ->andFilterWhere(['like', 'maskedPan', $this->maskedPan])
            ->andFilterWhere(['like', 'rrn', $this->rrn])
            ->andFilterWhere(['like', 'payed_time', $this->payed_time])
            ->andFilterWhere(['like', 'card_type', $this->card_type])
            ->andFilterWhere(['like', 'is_physical_card', $this->is_physical_card]);

        return $dataProvider;
    }
}
