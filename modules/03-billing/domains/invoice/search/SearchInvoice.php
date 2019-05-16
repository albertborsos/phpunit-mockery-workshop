<?php

namespace billing\domains\invoice\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use billing\domains\invoice\Invoice;

/**
 * SearchInvoice represents the model behind the search form of `billing\domains\invoice\Invoice`.
 */
class SearchInvoice extends Invoice
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'related_invoice_id', 'offer_id', 'amount'], 'integer'],
            [['type', 'item', 'comment'], 'safe'],
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
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Invoice::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'related_invoice_id' => $this->related_invoice_id,
            'offer_id' => $this->offer_id,
            'amount' => $this->amount,
        ]);

        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'item', $this->item])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
