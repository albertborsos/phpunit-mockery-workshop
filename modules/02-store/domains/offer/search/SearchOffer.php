<?php

namespace store\domains\offer\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use store\domains\offer\Offer;

/**
 * SearchOffer represents the model behind the search form of `store\domains\offer\Offer`.
 */
class SearchOffer extends Offer
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'price', 'discount', 'discount_workdays_period', 'customer_viewed_at', 'status'], 'integer'],
            [['name'], 'safe'],
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
        $query = Offer::find();

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
            'price' => $this->price,
            'discount' => $this->discount,
            'discount_workdays_period' => $this->discount_workdays_period,
            'customer_viewed_at' => $this->customer_viewed_at,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
