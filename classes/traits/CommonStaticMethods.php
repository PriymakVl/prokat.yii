<?php

namespace app\classes\traits;

use Yii;
use yii\helpers\StringHelper;

trait CommonStaticMethods
{
    
   public static function executeMethods($array, $methods)
    {
        if (!is_array($array)) return false;
        foreach ($methods as $method) {
            foreach ($array as $object) {
                $object->$method();
            }
        } 
        return $array;      
    }
    
    public static function checkArray($array)
    {
        if (empty($array)) return null;
        $result = null;
        foreach ($array as $item) {
            if (empty($item)) continue;
            else {
                $result = true;
                break;
            }
        }
        return $result;
    }
    
    public static function in_get($name)
    {
        if (Yii::$app->request->get($name)) return true;
        else return false;   
    }
    
    public static function in_post($name)
    {
        if (Yii::$app->request->get($name)) return true;
        else return false;   
    }
    
    public static function cutNotes($array, $length_max = 50, $suffix = ' ...')
    {
        foreach ($array as $obj) {
            $length_str = iconv_strlen($obj->note, 'utf-8');
            if ($length_max < $length_str)$obj->cutNote =  StringHelper::truncate($obj->note, $length_max, $suffix); 
        }
        return $array;
    }
	
	public static function setParentForList($ids, $parent_id)
	{
		$ids = explode(',', trim($ids));
        $objects = self::findAll($ids);
		foreach ($objects as $object) {
			$object->parent_id = $parent_id;
			$object->save();
		}
	}
}