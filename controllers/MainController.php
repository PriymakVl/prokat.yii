<?php

namespace app\controllers;

use Yii;
use yii\helpers\StringHelper;
use app\controllers\BaseController;
use app\modules\search\forms\SearchForm;
use app\modules\objects\models\Objects;

class MainController extends BaseController 
{
    public $layout = 'base';
    public $children;
          
    public function actionIndex() 
    {   
        $objects = Objects::getMainParent();
        return $this->render('index', compact('objects'));
    }
    
    public function actionSublist()
    {
        $obj_id = trim(Yii::$app->request->get('obj_id'));
        $this->children = Objects::find()->select('rus, eng, item, id, code')->where(['status' => Objects::STATUS_ACTIVE, 'parent_id' => $obj_id])->orderBy(['rating' => SORT_DESC, 'item' => SORT_ASC])->asArray()->all();
        if (empty($this->children)) return $obj_id;
        $this->getName();
        $this->cutName();
        return json_encode($this->children);
        exit();
    }
    
    private function getName()
    {
        foreach ($this->children as &$item) {
             if ($item['rus']) $item['name'] = $item['rus'];
             else $item['name'] = $item['eng'];
        }
    }
    
    private function cutName()
    {
         foreach ($this->children as &$item) {
             $length = iconv_strlen($item['name'], 'utf-8');
             if (30 < $length) $item['name'] =  StringHelper::truncate($item['name'], 30, ' ...'); 
        }
    }
    
    
    
    
    
    
}