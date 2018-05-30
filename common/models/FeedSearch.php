<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\FeedModel;

/**
 * FeedSearch represents the model behind the search form about `common\models\FeedModel`.
 */
class FeedSearch extends FeedModel
{
    
   //重写父类属性
    public function attributes() {
        return array_merge(parent::attributes(),['username']);
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'created_at'], 'integer'],
            [['content','username'], 'safe'],
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
        $query = FeedModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize'=>6],
            'sort'=>[
        	'defaultOrder'=>[
                'id'=>SORT_DESC,        			
        			],
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
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'content', $this->content]);
        
        //对新属性加过滤条件
        //对user表进行联表查询
        $query->join('INNER JOIN','user','feeds.user_id = user.id');
        //加入过滤条件
        $query->andFilterWhere(['like','user.username',$this->username]);
        //对sort方法增加一个属性username，设置既可以升序也可以降序
        $dataProvider->sort->attributes['username'] = 
        [
                'asc' =>['user.username'=>SORT_ASC],
                'desc'=>['user.username'=>SORT_DESC],
        ];

        return $dataProvider;
    }
}
