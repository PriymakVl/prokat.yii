<?php

namespace app\modules\applications\controllers;

use Yii;
use app\controllers\BaseController;
use app\modules\applications\models\Objects;
use app\modules\applications\models\ApplicationProduct;
use app\modules\applications\forms\ApplicationProductForm;
use app\modules\applications\logic\ApplicationLogic;

class ApplicationProductController extends BaseController 
{
    public $layout = "@app/views/layouts/base";
    
    public function actionIndex($product_id) 
    { 
        $product = ApplicationProduct::getOne($product_id, false, self::STATUS_ACTIVE);
		//$product->getApplications();
        if ($product->code) $object = Objects::getObjectByCode($product->code);
        if ($object) $object->getName();
        return $this->render('index', compact('product', 'object'));
    }
    
    public function actionList($department = null, $category = null) 
    { 
        $params = ApplicationProductLogic::getParams($department, $category);
        $list = ApplicationProduct::getList($params);
        $pages = ApplicationProduct::$pages;
        return $this->render('list', compact('list', 'params', 'pages'));
    }
    
    public function actionForm($product_id = null) 
    { 
        $product = ApplicationProduct::getOne($product_id, null, self::SATATUS_ACTIVE);
        $form = new OrderContentForm();
        
        if($form->load(Yii::$app->request->post()) && $form->validate() && $form->save($product)) { 
            return $this->redirect(['/application/product', 'item_id' => $form->item_id]);
        }   
        return $this->render('form', compact('product', 'form'));
    }
    
    public function actionDeleteOne($product_id) 
    {
        $item = ApplicationProduct::getOne($product_id);
        $item->deleteOne();
        return $this->redirect(['/application/product/list']);
        
    }
    
     // public function actionDeleteList($ids, $order_id) 
    // {
        // ApplicationProduct::deleteList($ids);
        // return $this->redirect(['/application/product/list']);
        
    // }
    
    // public function actionAddOne($obj_id)
    // {
        // $object = Objects::getOne($obj_id);
        // $item = OrderLogic::saveParamsFromObject($object);
        // $this->redirect(['/order/content/item', 'item_id' => $item->id]);
    // }
    
    // public function actionAddList($ids)
    // {
        // $objects = Objects::getArrayObjects($ids);
        // foreach ($objects as $object) {
            // (new OrderContent())->saveParamsFromObject($object);
        // }
        // $order_id = OrderLogic::getActiveOrderId();
        // $this->redirect(['/order/content/list', 'order_id' => $order_id]);
    // }
    
}