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
    
    public static function getMonthString($month, $lower)
    {
        switch($month) {
            case '01': return $lower ? 'январь' : 'Январь';
            case '02': return $lower ? 'февраль' : 'Февраль';
            case '03': return $lower ? 'март' : 'Март';
            case '04': return $lower ? 'апрель' : 'Апрель';
            case '05': return $lower ? 'май' : 'Май';
            case '06': return $lower ? 'июнь' : 'Июнь';
            case '07': return $lower ? 'июль' : 'Июль';
            case '08': return $lower ? 'август' : 'Август';
            case '09': return $lower ? 'сентябрь' : 'Сентябрь';
            case '10': return $lower ? 'октябрь' : 'Октябрь';
            case '11': return $lower ? 'ноябрь' : 'Ноябрь';
            case '12': return $lower ? 'декабрь' : 'Декабрь';
        }
    }
    
    public static function getArrayMonths()
    {
        return ['01' => 'Январь', '02' => 'Февраль', '03' => 'Март', '04' => 'Апрель', '05' => 'Май', '06' => 'Июнь',
            '07' => 'Июль', '08' => 'Август', '09' => 'Сентябрь', '10' => 'Октябрь', '11' => 'Ноябрь', '12' => 'Декабрь'
        ];
    }
    
    public static function codeWithoutVariant($code)
    {
        if (!$code) return false;
        else if (!strpos($code, '/')) return $code;
        else return explode('/', $code)[0]; 
    }
}