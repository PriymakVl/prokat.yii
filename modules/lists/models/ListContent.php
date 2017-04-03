<?php

namespace app\modules\lists\models;

use Yii;
use app\models\BaseModel;
use app\modules\objects\models\Objects;

class ListContent extends BaseModel
{
    public $child;
    
    public static function tableName()
    {
        return 'list_content';
    }

    public function checkChild()
    {
        $child = Objects::find()->where(['status' => self::STATUS_ACTIVE, 'parent_id' => $this->obj_id])->one();
        $this->child = $child ? true : false;
        return $this;    
    }
    
    public static function deleteListContent($list_id)
    {
        $content = self::getBylistId($list->id);
        if (!$content) return true;
        foreach ($content as $item) {
            $obj = self::findOne($item->id);
            $obj->deleteOne();
        }
        return true;
    }
    
    public static function getBylistId($id)
    {
        $content = self::find()->where(['status' => self::STATUS_ACTIVE, 'list_id' => $id])->orderBy(['rating' => SORT_DESC])->all();
        return self::executeMethods($content, ['checkChild']);
    }
    
    public function saveItem($obj, $list_id)
    {
        $this->obj_id = $obj->id;
        $this->name = $obj->name;
        $this->code = $obj->code;
        $this->note = $obj->note;
        $this->list_id = $list_id;
        return $this->save();
    }
    
}





