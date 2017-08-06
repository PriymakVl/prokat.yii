<?php

namespace app\modules\order\controllers;

use Yii;
use yii\web\ForbiddenHttpException;
use app\controllers\BaseController;
use app\modules\objects\models\Objects;
use app\modules\order\models\Order;
use app\modules\order\models\OrderContent;
use app\modules\order\forms\OrderContentForm;
use app\modules\order\logic\OrderLogic;

class OrderListContentController extends BaseController 
{
    public $layout = "@app/views/layouts/base";
    
    public function actionIndex($item_id) 
    { 
        $item = OrderContent::getOne($item_id, __METHOD__, self::STATUS_ACTIVE)->countWeightAll()->getPathDrawing()->getWeight()
            ->getDrawing();
        $order = Order::findOne($item->order_id);
        $order->getNumber();
        $object = Objects::getOne($item->obj_id, null, self::STATUS_ACTIVE);
        if ($object) $object->getParent()->getName();
        return $this->render('index', compact('order', 'item', 'object'));
    }
    
    public function actionList($order_id) 
    { 
        $order = Order::getOne($order_id, __METHOD__, self::STATUS_ACTIVE);
        $order->getNumber();
        $content = OrderContent::getItemsOfOrder($order->id);
        $state = OrderLogic::checkStateSession($order_id, 'order_id');
        return $this->render('list', compact('order', 'content', 'state'));
    }
    
    public function actionForm($order_id, $item_id = null) 
    { 
        $order = Order::getOne($order_id, __METHOD__, self::STATUS_ACTIVE);
        $order->getNumber();
        $item = OrderContent::getOne($item_id, null, self::STATUS_ACTIVE);
        $form = new OrderContentForm();
        
        if($form->load(Yii::$app->request->post()) && $form->validate() && $form->save($item)) { 
            return $this->redirect(['/order/content/item', 'item_id' => $form->item_id]);
        }   
        return $this->render('form', compact('item', 'form', 'order'));
    }
    
    public function actionDeleteOne($item_id) 
    {
        $item = OrderContent::getOne($item_id, __METHOD__, self::STATUS_ACTIVE);
        $item->deleteOne();
        return $this->redirect(['/order/content/list', 'order_id' => $item->order_id]);
        
    }
    
     public function actionDeleteList($ids, $order_id) 
    {
        OrderContent::deleteList($ids);
        return $this->redirect(['/order/content/list', 'order_id' => $order_id]);
        
    }
    
    public function actionAddObjectForm($order_id, $code)
    {
        $object = Objects::findOne(['code' => $code, 'status' => self::STATUS_ACTIVE]);  
        if (!$object) {
            //Yii::$app->getSession()->setFlash('error', 'Your Text Here..');  
            //return $this->redirect(['/order/content/list', 'order_id' => $order_id]); 
            exit('not find object by code');
        }
        $item = OrderLogic::saveParamsFromObject($object, $order_id);
        $this->redirect(['/order/content/item', 'item_id' => $item->id]);
    }
    
    public function actionAddOne($obj_id)
    {
        $object = Objects::getOne($obj_id, false, self::STATUS_ACTIVE);
        $item = OrderLogic::saveParamsFromObject($object);
        $this->redirect(['/order/content/item', 'item_id' => $item->id]);
    }
    
    public function actionAddList($ids)
    {
        $objects = Objects::getArrayObjects($ids);
        foreach ($objects as $object) {
            (new OrderContent())->saveParamsFromObject($object);
        }
        $order_id = OrderLogic::getActiveOrderId();
        $this->redirect(['/order/content/list', 'order_id' => $order_id]);
    }
    
    public function actionAddFile($file, $cat_dwg, $obj_id)
    {
        $object = Objects::getOne($obj_id, __METHOD__, self::STATUS_ACTIVE);
        $item_id = OrderLogic::addFileOfItemOrder($file, $cat_dwg, $object);
        if ($item_id) $this->redirect(['/order/content/item', 'item_id' => $item_id]);
        else throw new ForbiddenHttpException('error '.__METHOD__);
    }
    
    public function actionSetParent($ids, $parent_id, $order_id)
    {
        OrderContent::setParentForList($ids, $parent_id);
        return $this->redirect(['/order/content/list', 'order_id' => $order_id]);   
    }
    
}