<?php

namespace app\modules\standard\models;

use app\models\BaseModel;

class Standard extends BaseModel
{
    public $files;
    public $child;
    
    public static function tableName()
    {
        return 'standards';
    }
    
    public function getFiles()
    {
        $this->files = StandardFile::findAll(['status' => self::STATUS_ACTIVE, 'std_id' => $this->id]);
    }
    
    public function checkChild()
    {
        $this->child = parent::find()->select('id')->where(['status' => self::STATUS_ACTIVE, 'parent_id' => $this->id])->one();
        return $this;    
    }

}





