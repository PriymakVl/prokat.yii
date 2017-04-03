<?php

namespace app\forms;

use yii\base\Model;
use app\classes\interfaces\ConfigApp;
use app\classes\traits\CommonStaticMethods;

class BaseForm extends Model implements ConfigApp
{   
    public $note;
    public $services;
    
    use CommonStaticMethods;
    
    public function uploadFile($id, $file, $folder, $sufix = '')
    {
        if (!$file) return '';
        $filename = $id.$sufix.'.'.$file->extension;
        $res = $file->saveAs('files/'.$folder.'/'.$filename);
        if ($res) return $filename;
        else exit('error class ModelForm method uploadFile');
    }
    
     public function getArrayForDropDownList($array)
    {
        $typeitems = [];
        foreach ($array as $item) {
            $typeitems[$item->alias] = $item->name;    
        } 
        return $typeitems;   
    }

}

