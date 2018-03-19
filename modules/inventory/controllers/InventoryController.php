<?php

namespace app\modules\inventory\controllers;

use Yii;
use app\controllers\BaseController;
use app\modules\inventory\logic\InventoryLogic;
use app\modules\inventory\models\Inventory;
use app\modules\inventory\forms\InventoryForm;

class InventoryController extends BaseController 
{
    public $layout = "@app/views/layouts/base";
    
    public function actionIndex($inv_id) 
    {   
        $inv = Inventory::getOne($inv_id, false, self::STATUS_ACTIVE);
        $inv->getObject()->convertCategory();
        return $this->render('index', compact('inv'));
    }
    
    public function actionList($cat = null)
    {
        $params = InventoryLogic::getParams($cat);
                //debug($params);
        $list = Inventory::getListInventory($params);
        $pages = Inventory::$pages;
        return $this->render('list', compact('list', 'params', 'pages'));
    }
    
    public function actionForm($inv_id = null) 
    { 
        $inv = Inventory::getOne($inv_id, null, self::STATUS_ACTIVE);
        //debug($order);
        $form = new InventoryForm($inv);
        $form->getCategories();

        if($form->load(Yii::$app->request->post()) && $form->validate() && $form->save()) { 
            Yii::$app->session->setFlash('success', 'Инвентарный номер успешно '.($inv ? 'отредактирован' : 'создан'));
            $this->redirect(['/inventory', 'inv_id' => $form->inv->id]);
        }   
        return $this->render('form', compact('inv', 'form'));
    }
    
    public function actionDelete($inv_id)
    {
        $number = Inventory::findOne($inv_id);
        $number->deleteOne();
        Yii::$app->session->setFlash('success', 'Номер успешно удален');
        $this->redirect('/inventory/list');  
    }
    
}