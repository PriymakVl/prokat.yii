<?php

namespace app\modules\objects\models;

use Yii;
use yii\helpers\StringHelper;
use yii\helpers\ArrayHelper;
use app\models\BaseModel;
use app\modules\objects\logic\ObjectLogic;
use app\logic\BaseLogic;
use app\modules\order\logic\OrderLogic;

class Objects extends BaseModel
{
    public $name;
    public $parent;
    public $drawings;
    public $dwg;
    public $child;
    public $orders;
    public $similar;
    
    const MAIN_PARENTS = 0;
    
    public function behaviors()
    {
        return ['object-logic' => ['class' => ObjectLogic::className()]];
    }

    public static function tableName()
    {
        return 'objects';
    }
    
    public static function getMainParent()
    {
        $objects = self::find()->where(['status' => self::STATUS_ACTIVE, 'parent_id' => self::MAIN_PARENTS])->orderBy(['rating' => SORT_DESC])->all();
        return self::executeMethods($objects, ['getName']);
    }

    public function getName()
    {
        $this->name = $this->rus ? $this->rus : $this->eng;
        return $this;
    }

    public function getParent()
    {
        $this->parent = self::findOne(['id' => $this->parent_id, 'status' => self::STATUS_ACTIVE]);
        if ($this->parent) $this->parent->getName();
        return $this;
    }

    public static function getChildren($parent_id, $sort)
    {
        if ($sort == 'standard') $children = self::find()->where(['status' => self::STATUS_ACTIVE, 'parent_id' => $parent_id])->andWhere(['<', 'item', 300])->orderBy(['rating' => SORT_DESC, 'item' => SORT_ASC])->all();
        else if ($sort == 'unit') $children = self::find()->where(['status' => self::STATUS_ACTIVE, 'parent_id' => $parent_id])->andWhere(['>', 'item', 299])->orderBy(['rating' => SORT_DESC, 'item' => SORT_ASC])->all();
        //else if ($sort == 'app')
        else if ($sort == 'highlight') $children = self::find()->where(['status' => self::STATUS_ACTIVE, 'parent_id' => $parent_id, 'color' => 1])->orderBy(['item' => SORT_ASC])->all();
        else $children = self::find()->where(['status' => self::STATUS_ACTIVE, 'parent_id' => $parent_id])->orderBy(['rating' => SORT_DESC, 'item' => SORT_ASC])->all();
        $children = self::executeMethods($children, ['getOrders']);
        if ($sort == 'order') $children = ObjectLogic::selectObjectsWithOrder($children);
        return ObjectLogic::prepareChildren($children); 
    }

    public function checkChild()
    {
        $child = self::find()->select('id')->where(['status' => self::STATUS_ACTIVE, 'parent_id' => $this->id])->one();
        $this->child = $child ? true : false;
        return $this;    
    }
    
    public function checkDrawing()
    {
        $this->dwg = ObjectLogic::checkDrawing($this); 
        return $this;      
    }
    
    public function copy($parent_id) 
    {
        $this->id = null;
        $this->parent_id = $parent_id;
        $this->setIsNewRecord(true);
        if (!$this->save(false)) throw new ForbiddenHttpException('error '.__METHOD__); 
    }
    
    public static function searchCode($code)
    {
        $objects = self::find()->where(['status' => self::STATUS_ACTIVE])->andWhere(['like', 'code', $code])->all();
        if (count($objects) > 1) self::executeMethods($objects, ['getName', 'getParent', 'getAlias']);
        return $objects;
    }
    
    public static function deleteList($ids)
    {
        $objects = self::getArrayObjects($ids);
        foreach ($objects as $obj) {
            $obj->deleteOne();
        }  
    }
    
    public static function copyList($ids, $parent_id)
    {
        $children = self::find()->select('code')->where(['status' => self::STATUS_ACTIVE, 'parent_id' => $parent_id])->column();
		$ids = explode(',', $ids);
		$objects = Objects::findAll($ids);
        $objects = ObjectLogic::deleteExistingObjects($objects, $children);
        if (!$objects) return;
        foreach ($objects as $obj) {
            $obj->copy($parent_id);
        } 
    }
    
    public static function getArrayObjects($ids)
    {
        $ids = explode(',', trim($ids));
        return self::findAll($ids);    
    }
    
    public static function changeParent($ids, $parent_id)
    {
        $ids = explode(',', trim($ids));
        $objects = self::findAll($ids);
        $children = self::find()->select('code')->where(['status' => self::STATUS_ACTIVE, 'parent_id' => $parent_id])->column();
        $objects = ObjectLogic::deleteExistingObjects($objects, $children);
        if (!$objects) return;
        return ObjectLogic::changeParentList($objects, $parent_id);    
    }
    
    public function getOrders()
    {
        //sort standard danieli
        if ($this->code && $this->code[0] != '0') $this->orders = OrderLogic::getOrdersByCode($this->code);
        return $this;
    }
    
    public static function getChildrenForMainPage($parent_id)
    {
        $data = Objects::find()->select('rus, eng, item, id, code, color')->where(['status' => self::STATUS_ACTIVE, 'parent_id' => $parent_id])
        //->andWhere(['>', 'item', 299])->andWhere(['<', 'item', 99])
        ->orderBy(['rating' => SORT_DESC, 'item' => SORT_ASC])->asArray()->all();
        foreach ($data as $item) {
            if ($item['item'] == 0 || $item['item'] > 299) $children[] = $item;
        }
        return $children;
    }
    
    public function countSimilar()
    {
        if ($this->code) {
            $this->similar = (int) Objects::find()->where(['code' => $this->code, 'status' => self::STATUS_ACTIVE])->count();    
        }
        return $this;
    }
	

}





