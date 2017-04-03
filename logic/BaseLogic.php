<?php

namespace app\logic;

use yii\base\Behavior;
use app\classes\interfaces\ConfigApp;
use app\models\Tag;
use app\classes\traits\CommonStaticMethods;

class BaseLogic  extends Behavior implements ConfigApp
{
    public $cutNote;
    
    use CommonStaticMethods;
    
    public function convertTag($type, $key)
    {
        $tags = Tag::get($type);
        if (array_key_exists($key, $tags)) return $tags[$key];
        else return false;
    }
    
    public function getServices($obj)
    {
        $obj->services = Tag::get('service');
        return $obj;
    }
    
    public function convertService($obj)
    {
        $obj->service = $this->convertTag('service', $obj->service);
        return $obj;
    }
    
    public function convertDate($obj, $sufix = ' г.', $template = 'd.m.y')
    {
        if ($obj->date) $obj->date = date($template, $obj->date).$sufix;
        return $obj;
    }
    
    public function executeMethodsOfObjects($array, $methods)
    {
        return self::executeMethods($array, $methods);    
    }
    
    
    
    public function showError($method) {
        $method = '<span style="color: red;">'.$method.'</span>';
        die('erorr '.$method);
    }
    
    

}





