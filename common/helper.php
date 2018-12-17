<?php
if (!function_exists('dd')) {
    function dd($param)
    {
        if(is_array($param)){
            foreach ($param as $p)  {
                \yii\helpers\VarDumper::dump($p, 10, true);
                echo '<pre>';
            }
        }else{
            \yii\helpers\VarDumper::dump($param, 10, true);
            echo '<pre>';
        }
        exit(1);
    }
}
