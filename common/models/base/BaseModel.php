<?php 
namespace common\models\base;

use yii\db\ActiveRecord;

class  BaseModel extends ActiveRecord
{  
  /**
   * 获取分页数据
   * @param  [type]  $query    [description]
   * @param  integer $curPage  [当前页]
   * @param  integer $pageSize [每页显示数]
   * @param  [type]  $search   [description]
   */
	public function getPages($query,$curPage = 1,$pageSize = 10,$search =null,$type='object')
	{
            if($search)
                     $query =$query->andFilerWhere($search);
       
            //总条数
            $data['count'] =$query->count();

            if(!$data['count']){
                     return ['count'=>0,'curPage'=>$curPage,'pageSize'=>$pageSize,
                       'start'=>'0','end'=>0,'data'=>[]
                      ];
            }
            //超过实际页数,不取curPage为当前页 
            $curPage = (ceil($data['count']/$pageSize)<$curPage)?ceil($data['count']/$pageSize):$curPage;      
            //当前页
            $data['curPage'] = $curPage;
            //每页显示条数
            $data['pageSize'] = $pageSize;
            //起始页
            $data['start'] =($curPage-1)*$pageSize+1;
            //末页
            $data['end'] = (ceil($data['count']/$pageSize) == $curPage)
                           ?$data['count']:($curPage-1)*$pageSize+$pageSize;
            //数据(对象数据、数组数据)
            if($type == 'object'){
                 $data['data'] = $query->offset(($curPage-1)*$pageSize)
                                ->limit($pageSize)
                                ->asArray()
                                ->all(); 
            }else{
                $data['data'] = $query->offset(($curPage-1)*$pageSize)
                                ->limit($pageSize)
                                ->all(); 
            }
            return $data;
	}

}