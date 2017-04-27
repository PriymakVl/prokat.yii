<?php

namespace app\modules\letters\models;

use yii\web\ForbiddenHttpException;
use yii\data\Pagination;
use app\models\BaseModel;
use app\modules\letters\logic\LetterLogic;

class Letter extends BaseModel
{
    public $numberOut;
    public $whomPosition;
    public $whomName;
    
    const PAGE_SIZE = 15;
    
    public static function tableName()
    {
        return 'letters';
    }
    
    public function behaviors()
    {
    	return ['letter-logic' => ['class' => LetterLogic::className()]];
    }
    
    public function getLetterList($params)
    {
        $list = Letter::getList($params, self::PAGE_SIZE);
        return self::executeMethods($list, ['getNumber', 'getWhomPosition']);
    }
    
    public function getNumber()
    {
        $this->number = 12;
        return $this;
    }
    
    public function getWhom()
    {
        $this->whom = $this->whom ? unserialize($this->whom) : null;
        if (is_array($this->whom)) {
            $position = key($this->whom); 
            $name = $this->whom[$position];
            $this->whom = $position.' '.$name;
        }
        return $this;
    }
    
    public function getCopy()
    {
        $copy = $this->copy ? unserialize($this->copy) : null;
        if (is_array($copy)) {
            foreach ($copy as $item) {
                $position = key($item);
                $name = $item[$position];
                $array[] = $position.' '.$name;    
            } 
        }
        $this->copy = $array;
        return $this;
    }
    
    public function getWhomPosition()
    {
        $whom = unserialize($this->whom);
        $this->whomPosition = key($whom);
        return $this;
    }
    
    public function getWhomName()
    {
        $whom = unserialize($this->whom);
        $key = key($whom);
        $this->whomName = $whom[$key];
        return $this;
    }
    

}





