<?php

namespace app\modules\lists\controllers;

use Yii;
use app\controllers\BaseController;
use app\modules\lists\logic\ListLogic;
use app\modules\lists\models\Lists;
use app\modules\lists\models\ListContent;
use app\modules\lists\forms\ListForm;

class ListController extends BaseController
{
    public $layout = "@app/views/layouts/base";
    
    public function actionIndex()
    {
        $list = Lists::getOneList();
        $list->convertType();
        $content = ListContent::getBylistId($list->id);
        return $this->render('index', compact('list', 'content'));
    }
    
    public function actionUpdateAll()
    {
        $content = ListContent::findAll(['status' => Lists::STATUS_ACTIVE]);
        
        foreach ($content as $elem) {
                $obj = Objects::findOne($elem->obj_id);
                $obj->getName();
                $elem->name = $obj->name; 
                $elem->code = $obj->code;
                if (!$elem->note) $elem->note = $obj->note;
                $elem->save();   
        }
        return $this->redirect(['/lists']);
    }
    
    public function actionForm($list_id = NULL)
    {     
        $list = (int)$list_id ? Lists::findOne($list_id) : null;       
        $form = new ListForm();
        $form->getTypes();
        if($form->load(Yii::$app->request->post()) && $form->validate() && $form->save($list)) {
            ListLogic::setSessionActiveList($form->list_id);
            return $this->redirect(['/list/active']);
        }        
        else return $this->render('list_form', compact('form', 'list'));    
    }
    
    public function actionAll($type = null)
    {
        $params = ListLogic::getParams();
        $all = Lists::getAllList($params);
        $pages = Lists::$pages;
        return $this->render('list_all', compact('all', 'params', 'pages'));
    }
    
    public function actionDelete($list_id = null) 
    {
        $list = Lists::getOne($list_id, false, self::STATUS_ACTIVE);
        ListContent::deleteListContent($list_id);
        ListLogic::deleteListFromSession();
        if ($list->deleteOne()) return $this->redirect(['/list/active']);
    }
    //do list active
    public function actionSetActive($list_id)
    {
        ListLogic::setActive($list_id, 'list-active');
        $this->redirect('/list/active');       
    }
}
