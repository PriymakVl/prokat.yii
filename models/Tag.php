<?php

namespace app\models;

use Yii;
use app\models\BaseModel;
use app\logic\TagLogic;

class Tag extends BaseModel
{
    public static function tableName()
    {
        return 'tags';
    }
    
    public static function get($type)
    {
        $tags = Tag::findAll(['status' => static::STATUS_ACTIVE, 'type' => $type]);
        if (empty($tags)) return [];
        return TagLogic::getArrayAliasAndName($tags);
    }
    
    //    public static function getArrayAliasAndName($type) 
//    {
//        $array = Teg::find()->where(['status' => static::STATUS_ACTIVE, 'type' => $type])->all();
//        $convert = [];
//        foreach ($array as $item) {
//            $convert[$item->alias] = $item->name;
//        }
//        return $convert;
//    }
}