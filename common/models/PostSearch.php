<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PostModel;

/**
 * PostSearch represents the model behind the search form about `common\models\PostModel`.
 */
class PostSearch extends PostModel
{
    //重写父类属性
    public function attributes() {
        return array_merge(parent::attributes(),['cat_name']);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cat_id', 'user_id', 'is_valid', 'created_at', 'updated_at'], 'integer'],
            [['title', 'summary', 'content', 'label_img', 'user_name','cat_name'], 'safe'],
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
        $query = PostModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            //分页
        	'pagination' => ['pageSize'=>5],
            //排序
        	'sort'=>[
        		'defaultOrder'=>[
        		'id'=>SORT_DESC,        			
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
            'cat_id' => $this->cat_id,
            'user_id' => $this->user_id,
            'is_valid' => $this->is_valid,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'summary', $this->summary])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'label_img', $this->label_img])
            ->andFilterWhere(['like', 'user_name', $this->user_name]);
        
        //对新属性加过滤条件
        //对cats表进行联表查询
        $query->join('INNER JOIN','cats','posts.cat_id = cats.id');
        //加入过滤条件
        $query->andFilterWhere(['like','cats.cat_name',$this->cat_name]);
        //对sort方法增加一个属性cat_name，设置既可以升序也可以降序
        $dataProvider->sort->attributes['cat_name'] = 
        [
                'asc' =>['cats.cat_name'=>SORT_ASC],
                'desc'=>['cats.cat_name'=>SORT_DESC],
        ];

        return $dataProvider;
    }
}
