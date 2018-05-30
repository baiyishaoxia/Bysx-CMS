<?php 
namespace frontend\widgets\banner;

use Yii;
use yii\base\Widget;

/**
 *轮播组件
 */
class BannerWidget extends Widget
{
	public $items =[];

	public function init()
	{  

        if(empty($this->items)){
                $this->items =[
                [  'label'=>'demo',
                   'image_url'=>'/statics/images/banner/b_0.jpg',
                   'url'=>['site/index'],
                   'html'=>yii::t('common','Live and learn'),
                   'active'=>'active',

                ],
                [  'label'=>'demo',
                   'image_url'=>'/statics/images/banner/b_1.jpg',
                   'url'=>['site/index'],
                   'html'=>yii::t('common','In the one to find it is'),
                ],
                  ['label'=>'demo',
                   'image_url'=>'/statics/images/banner/b_2.jpg',
                   'url'=>['site/index'],
                   'html'=>yii::t('common','White little xia'),
                ],

                ];
       }
	}

	public function run()
	{   
		$data['items']=$this->items;
		return $this->render('index',['data'=>$data]);
	}
}