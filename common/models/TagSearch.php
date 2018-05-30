<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TagModel;

/**
 * TagSearch represents the model behind the search form about `common\models\TagModel`.
 */
class TagSearch extends TagModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'post_num'], 'integer'],
            [['tag_name'], 'safe'],
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
        $query = TagModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            //分页
        	'pagination' => ['pageSize'=>10],
            //排序
        	'sort'=>[
        			'defaultOrder'=>[
        			  'post_num'=>SORT_DESC,        			
        			],
        			//'attributes'=>['id','title'],
        	],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'post_num' => $this->post_num,
        ]);

        $query->andFilterWhere(['like', 'tag_name', $this->tag_name]);

        return $dataProvider;
    }
}
