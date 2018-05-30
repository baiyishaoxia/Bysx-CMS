<?php 
namespace frontend\widgets\tag;
use yii\helpers\Url;
/**
 * 标签云
 */
use Yii;
use yii\base\Widget;
use common\models\TagModel;

class TagWidget extends Widget
{
    /**
     * 文章列表标题
     * @var string
     */
   public $title ='';
    /**
     * 显示条数
     * @var integer
     */
   public $limit =20;
   
    /**
     * 是否显示更多
     * @var boolean
     */
   public $more =true;

   public function run()
   {
      $res =TagModel::find()
      ->orderBy(['post_num'=>SORT_DESC]) //关联的文章数
      ->limit($this->limit)
      ->all();

      $result['title'] = $this->title?:''.yii::t('common','A tag cloud').'';
      $result['more']=Url::to(['post/index','sort'=>'tag']);
      $result['body'] =$res?:[];

      return $this->render('index',['data'=>$result]);
   }

}