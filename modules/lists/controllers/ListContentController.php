<?php

namespace app\modules\lists\controllers;

use Yii;
use app\controllers\BaseController;
use app\modules\objects\models\Objects;
use app\modules\lists\models\Lists;
use app\modules\lists\models\ListContent;
use app\modules\lists\forms\ListContentForm;
use app\modules\Lists\logic\ListLogic;


class ListContentController extends BaseController 
{
    public $layout = "@app/views/layouts/base";
    
    public function actionDelete($id = null) 
    {
        $item = ListContent::getOne($id, __METHOD__); 
        $item->deleteOne();     
        return $this->redirect('/list/active');
    }
    
    public function actionForm($id = null) 
    {
        $item = ListContent::getOne($id, __METHOD__); 
        $form = new ListContentForm();
        if($form->load(Yii::$app->request->post()) && $form->validate() && $form->update($item)) {
            return $this->redirect(['/list/active']);
        }   
        return $this->render('form', compact('form', 'item'));
    }
    
    public function actionAdd($obj_id = null)
    {
        $list_id = ListLogic::getActiveListId();
        $obj = Objects::getOne($obj_id, __METHOD__);
        $obj->getName();
        Yii::createObject(ListContent::class)->saveItem($obj, $list_id);
        return $this->redirect(['/list/active']);
    }
     
}