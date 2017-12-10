<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Flower;

/**
 * FlowerSearch represents the model behind the search form about `app\models\Flower`.
 */
class FlowerSearch extends Flower
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'genus_id'], 'integer'],
            [['name', 'description', 'date_create', 'date_update'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Flower::find()->with(['genus', 'flowerImages'])->orderBy('name');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
		
		$dataProvider->pagination = false;

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date_create' => $this->date_create,
            'date_update' => $this->date_update,
            'genus_id' => $this->genus_id,
        ]);

        $query->andFilterWhere(['like', 'name', "$this->name%", false]);

        return $dataProvider;
    }
}
