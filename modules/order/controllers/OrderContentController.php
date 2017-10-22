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
        $form = new OrderContentForm($item);
        $form->getNewNumberDepartmentDwg()->getArrayDetailNames();
        
        if($form->load(Yii::$app->request->post()) && $form->validate() && $form->save()) { 
            Yii::$app->session->setFlash('success-order-item', 'Элемент заказа успешно '.($item ? 'отредактирован' : 'создан'));
            return $this->redirect(['/order/content/item', 'item_id' => $form->element->id]);
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
    
    public function actionItemsManagment($ids, $order_id) 
    {
        OrderLogic::deleteOrAddItemContent($ids);
        return $this->redirect(['/order/content/list', 'order_id' => $order_id]);
        
    }
    
    public function actionAddOne($obj_id)
    {
        $object = Objects::getOne($obj_id, false, self::STATUS_ACTIVE); 
        $order_id = OrderLogic::getIdAciveOrder('Объект не добавлен в заказ. Нет активного заказа');
        if (!$order_id) return $this->redirect(['/order/list']);
        $item = OrderLogic::saveParamsFromObject($object, $order_id, \Yii::$app->request->get('file'));
        if ($item) $this->redirect(['/order/content/item', 'item_id' => $item->id]);
    }
    
    public function actionAddList($ids, $parent_id)
    {

        $objects = Objects::getArrayObjects($ids);
        $order_id = OrderLogic::getIdAciveOrder(count($objects) == 1 ? 'Объект не добавлен' : 'Объекты не добавлены'.' в заказ. Нет активного заказа.');
        if (!$order_id) return $this->redirect(['/order/list']);
        foreach ($objects as $object) {
            $result = OrderLogic::saveParamsFromObject($object, $order_id, \Yii::$app->request->get('file'));
        }
        $this->redirect(['/order/content/list', 'order_id' => $order_id]);
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