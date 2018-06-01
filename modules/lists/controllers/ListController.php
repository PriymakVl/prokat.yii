<?php

namespace app\modules\lists\controllers;

use Yii;
use app\controllers\BaseController;
use app\modules\lists\logic\ListLogic;
use app\modules\lists\models\Lists;
use app\modules\lists\models\ListContent;
use app\modules\lists\forms\ListForm;
use app\models\Tag;

class ListController extends BaseController
{
    public $layout = "@app/views/layouts/base";
    
    public function actionIndex()
    {
        $list = Lists::getOneList();
        $list->convertType();
        $content = ListContent::getBylistId($list->id);
        return $this->render('index', compact('index', 'content'));
    }
    
    public function actionForm($list_id = null)
    {     
        $list = (int)$list_id ? Lists::findOne($list_id) : null;
        $form = new ListForm($list);
        //$form->getTypes();
        if($form->load(Yii::$app->request->post()) && $form->validate() && $form->save()) {
            ListLogic::setSession($form->list->id, 'list-active');
            return $this->redirect(['/list/content', 'list_id' => $form->list->id]);
        }        
        else return $this->render('form', compact('form', 'list'));
    }
    
    public function actionAll($type = null)
    {
        $params = ListLogic::getParams();
        $all = Lists::getAllList($params);
        $pages = Lists::$pages;
        $groups = Tag::findAll(['status' => Tag::STATUS_ACTIVE, 'type' => 'list']);//for filter lists
        return $this->render('all', compact('all', 'params', 'pages', 'groups'));
    }
    
    public function actionDelete($list_id = null) 
    {
        $list = Lists::getOne($list_id, false, self::STATUS_ACTIVE);
        ListContent::deleteListContent($list_id);
        if ($list->deleteOne()) {
            ListLogic::deleteSession('list_active');
            Yii::$app->session->setFlash('success', 'Список успешно удален');
            return $this->redirect(['/lists']);
        }
        else {
            Yii::$app->session->setFlash('danger', 'При удалении списка произошла ошибка');
            return $this->redirect(Yii::$app->request->referrer);
        }
    }

    public function actionActive()
    {
        $list_id = ListLogic::getSession('list-active');
        if ($list_id) return $this->redirect(['/list/content', 'list_id' => $list_id]);
        Yii::$app->session->setFlash('danger', 'Активный список не указан');
        return $this->redirect(['/lists']);
    }
    //do list active
    public function actionSetActive($list_id)
    {
        ListLogic::setSession($list_id, 'list-active');
        return $this->redirect(['/list/content', 'list_id' => $list_id]);
    }
}
