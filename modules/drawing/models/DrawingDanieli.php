<?php

namespace app\modules\drawing\models;

use app\models\BaseModel;
use app\modules\drawing\logic\DrawingLogic;

class DrawingDanieli extends BaseModel
{
    public $catName = 'Danieli';
    public $category = 'danieli';
    
    public static function tableName()
    {
        return 'drawings_danieli';
    }
    
    public static function getAllForObject($obj)
    {
           $code = self::getCodeWithoutDash($obj->code); 
           $drawings = self::find()->where(['code' => $code, 'status' => self::STATUS_ACTIVE])
                ->orderBy(['revision' => SORT_DESC, 'sheet' => SORT_ASC])->all();  
                //debug($drawings);
        return DrawingLogic::cutNotes($drawings);  
    }
    
    public static function check($obj)
    {
        if ($obj->equipment == 'danieli') $code = self::getCodeWithoutDash($obj->code);
		else $code = $obj->code;
        return self::findOne(['code' => $code, 'equipment' => $obj->equipment, 'status' => self::STATUS_ACTIVE]);   
    }
    
    public static function getCodeWithoutDash($code) 
    {
        if ( strpos($code, '-')) return substr(str_replace('-', '', $code), 6);//removes unwanted characters
		else return $code;    
    }
    
    public static function getDrawignByNameFile($filename) 
    {
        $res = explode('.', $filename);
        $dwg = self::find()->filterWhere(['like', 'file', $res[0]])->one(); 
        if (!$dwg) return new DrawingVendor();
        else return $dwg; 
    }
    
    public static function countNumberDrawingsOneRevision($drawings)
    {
        foreach ($drawings as $dwg) {
            $revisions[] = $dwg->revision;
        }
        $revisions = array_unique($revisions);
        $new_revision = $revisions[0];
        if (count($revisions) == 1) return count($drawings);
        foreach ($drawings as $dwg) {
            if ($dwg->revision == $new_revision) $new_drawings[] = $dwg;
        }
        return count($new_drawings);
    }

}





