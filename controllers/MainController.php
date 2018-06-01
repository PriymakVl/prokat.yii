<?php

namespace app\controllers;

use yii\helpers\Url;
use app\modules\objects\models\Objects;

class MainController extends BaseController 
{
    public $layout = 'base';
          
    public function actionIndex() 
    {
        $objects = Objects::getMainParent();
//        debug($objects, false);
//        foreach ($objects as $object) {
//            $children = Objects::find()->where(['status' => self::STATUS_ACTIVE, 'parent_id' => $object->id])->orderBy(['item' => SORT_ASC])->all();
//            $object->breadcrumbsForMainPage = $this->buildBreadcrumbs($children);
//        }
        return $this->render('index', compact('objects'));
    }

    private function buildBreadcrumbs($objects)
    {
        $html = '';
        for ($i = 0; $i < 5; $i++) {
            if (empty($objects[$i])) break;
            $url = Url::to(['/object/specification', 'obj_id' => $objects[$i]->id]);
            $html .= '<a class="main-breadcrumbs" href="'.$url.'">'.$objects[$i]->alias.'</a> / ';
        }
        return $html.' ...';
    }
    
//    public function actionSublist()
//    {
//        $obj_id = trim(Yii::$app->request->get('obj_id'));
//        //$obj_id = 13182;
//        $this->children = Objects::getChildrenForMainPage($obj_id);
//        if (empty($this->children)) return $obj_id;
//        $this->getName();
//        $this->cutName();
//        $this->checkOrder();
//        $this->checkParent();
//        return json_encode($this->children);
//        exit;
//    }
    
//    private function getName()
//    {
//        foreach ($this->children as &$item) {
//             if ($item['rus']) $item['name'] = $item['rus'];
//             else $item['name'] = $item['eng'];
//        }
//    }
    
//    private function cutName()
//    {
//         foreach ($this->children as &$item) {
//             $length = iconv_strlen($item['name'], 'utf-8');
//             if (30 < $length) $item['name'] =  StringHelper::truncate($item['name'], 30, ' ...');
//        }
//    }
    
//    private function checkOrder()
//    {
//        $count = count($this->children);
//        for ($i = 0; $i < $count; $i++) {
//			$this->children[$i]['order'] = '0';
//            if ($this->children[$i]['code'] && $this->children[$i]['code'] != '0') {
//                $order = OrderContent::checkOrderByCode($this->children[$i]['code']);
//				if ($order) $this->children[$i]['order'] = '1';
//            }
//        }
//    }
    
//    private function checkParent()
//    {
//        $count = count($this->children);
//        for ($i = 0; $i < $count; $i++) {
//            $children = Objects::find()->select('id')->where(['status' => self::STATUS_ACTIVE, 'parent_id' => $this->children[$i]['id']])->one();;
//            if ($children) $this->children[$i]['parent'] = '1';
//            else $this->children[$i]['parent'] = '0';
//        }
//    }
    
    
    
    
    
    
}