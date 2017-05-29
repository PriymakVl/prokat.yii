<?php

namespace app\modules\applications\controllers;

use Yii;
use yii\web\ForbiddenHttpException;
use app\controllers\BaseController;
use app\modules\objects\models\Objects;
use app\modules\applications\models\Application;
use app\modules\applications\models\ApplicationContent;
use app\modules\applications\forms\ApplicationContentForm;
use app\modules\applications\logic\ApplicationLogic;

class ApplicationContentController extends BaseController 
{
    public $layout = "@app/views/layouts/base";
    
    public function actionIndex($item_id) 
    { 
        $item = ApplicationContent::getOne($item_id);
        $item->getProduct();
        $app = Application::getOne($item->app_id);
        if ($item->product->code) $object = Objects::getObjectByCode($item->producnt->code);
        if ($object) $object->getParent()->getName();
        return $this->render('index', compact('app', 'item', 'object'));
    }
    
    public function actionList($app_id) 
    { 
        $app = Application::getOne($app_id, false, self::STATUS_ACTIVE);
        $content = ApplicationContent::getItemsOfApplication($app->id);
        //debug($content);
        $state = ApplicationLogic::checkStateSession($app_id, 'app_id');
        return $this->render('list', compact('app', 'content', 'state'));
    }
    
    public function actionForm($order_id, $item_id = null) 
    { 
        $order = Order::findOne($order_id);
        $order->getNumber();
        $item = OrderContent::getOne($item_id, null);
        $form = new OrderContentForm();
        
        if($form->load(Yii::$app->request->post()) && $form->validate() && $form->save($item)) { 
            return $this->redirect(['/order/content/item', 'item_id' => $form->item_id]);
        }   
        return $this->render('form', compact('item', 'form', 'order'));
    }
    
    public function actionDeleteOne($item_id) 
    {
        $item = OrderContent::getOne($item_id);
        $item->deleteOne();
        return $this->redirect(['/order/content/list', 'order_id' => $item->order_id]);
        
    }
    
     public function actionDeleteList($ids, $order_id) 
    {
        OrderContent::deleteList($ids);
        return $this->redirect(['/order/content/list', 'order_id' => $order_id]);
        
    }
    
    public function actionAddOne($obj_id)
    {
        $object = Objects::getOne($obj_id);
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
    
}