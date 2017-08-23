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
                if (is_array($method)) $object->$method[0]($method[1]);
                else $object->$method();
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
    
   	public static function deleteList($ids)
	{
		$ids = explode(',', trim($ids));
        $objects = self::findAll($ids);
		foreach ($objects as $object) {
			$object->status = self::STATUS_INACTIVE;
			$object->save();
		}
	}
    
    public static function convertMonth($month)
    {
        switch($month) {
            case '1': return 'Январь';
            case '2': return 'Февраль';
            case '3': return 'Март';
            case '4': return 'Апрель';
            case '5': return 'Май';
            case '6': return 'Июнь';
            case '7': return 'Июль';
            case '8': return 'Август';
            case '9': return 'Сентябрь';
            case '10': return 'Октябрь';
            case '11': return 'Ноябрь';
            case '12': return 'Декабрь';
        }
    }
    
    public static function codeWithoutVariant($code)
    {
        if (!$code) return false;
        else if (!strpos($code, '/')) return $code;
        else return explode('/', $code)[0]; 
    }
}