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

class OrderContentController extends BaseController 
{
    public $layout = "@app/views/layouts/base";
    
    public function actionIndex($item_id) 
    { 
        $item = OrderContent::getOne($item_id, false, self::STATUS_ACTIVE)->countWeightAll()->getPathDrawing()->getWeight()
            ->getDrawing()->getMaterialWithGost()->getDimensions();
            //debug($item);
        $order = Order::findOne($item->order_id);
        $order->getNumber()->checkActive('order-active');
        return $this->render('index', compact('order', 'item'));
    }
    
    public function actionList($order_id) 
    { 
        $order = Order::getOne($order_id, false, self::STATUS_ACTIVE);
        $order->getNumber()->checkActive('order-active');
        $content = OrderContent::getItemsOfOrder($order->id);
        return $this->render('list', compact('order', 'content'));
    }
    
    public function actionForm($order_id, $item_id = null) 
    { 
        $order = Order::getOne($order_id, false, self::STATUS_ACTIVE);
        $order->getNumber();
        $item = OrderContent::getOne($item_id, null, self::STATUS_ACTIVE);
        if ($item) $item->dimensions = unserialize($item->dimensions);
        //debug($item->dimensions['type']);
        $form = new OrderContentForm();
        
        if($form->load(Yii::$app->request->post()) && $form->validate() && $form->save($item)) { 
            Yii::$app->session->setFlash('success-order-item', 'Элемент заказа успешно '.($item ? 'отредактирован' : 'создан'));
            return $this->redirect(['/order/content/item', 'item_id' => $form->item_id]);
        }   
        return $this->render('form', compact('item', 'form', 'order'));
    }
    
    public function actionDeleteOne($item_id) 
    {
        $item = OrderContent::getOne($item_id, false, self::STATUS_ACTIVE);
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
    
    public function actionAddList($ids, $parent_id)
    {

        $objects = Objects::getArrayObjects($ids);
        foreach ($objects as $object) {
            $result = OrderLogic::saveParamsFromObject($object);
            if (!$result) {
                throw new ForbiddenHttpException('Не указан активный заказ');
                //\Yii::$app->session->setFlash('error-active', 'Не указан активный заказ');
                //$this->redirect(['/object/specification', 'obj_id' => $parent_id]);
            }
        }
        $active_id = OrderLogic::getActive('order-active');
        $this->redirect(['/order/content/list', 'order_id' => $active_id]);
    }
    
    public function actionAddFile($file, $cat_dwg, $obj_id)
    {
        $object = Objects::getOne($obj_id, false, self::STATUS_ACTIVE);
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