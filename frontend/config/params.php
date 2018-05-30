<?php
return [
    'adminEmail' => 'admin@example.com',
    //默认头像
    'avatar'=>[
    'small'=>'/statics/images/avatar/small.jpg',

    ],

     //添加文章时默认使用图地址
     //每次刷新随机之后固定
     'default_upload_img'=>'/statics/images/upload/upload_default'.rand(1,10).'.jpg',
     //每次刷新随机之后随机
     'default_rand_img'=>'/statics/images/upload/upload_default',
     
     'aboutUser' => '',
    
     //重定向的伪静态
     'suffix'=>'.jsp',//后缀
    
];
