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

    public function actionListContent($list_id)
    {
        $list = Lists::findOne(['id' => $list_id, 'status' => Lists::STATUS_ACTIVE]);
        $list->checkActive('list-active');
        $content = ListContent::find()->where(['list_id' => $list_id, 'status' => Lists::STATUS_ACTIVE])->orderBy(['rating' => SORT_DESC])->all();
        return $this->render('content', compact('list', 'content'));
    }
    public function actionDelete($id)
    {
        $item = ListContent::getOne($id, false, self::STATUS_ACTIVE); 
        $item->deleteOne();
        Yii::$app->session->setFlash('success', 'Элемент списка успешно удален');
        return $this->redirect(['/list/content', 'list_id' => $item->list_id]);
    }
    
    public function actionForm($id) 
    {
        $item = ListContent::getOne($id, false, self::STATUS_ACTIVE); 
        $form = new ListContentForm($item);
        if($form->load(Yii::$app->request->post()) && $form->validate() && $form->update()) {
            Yii::$app->session->setFlash('success', 'Элемент списка успешно отредактирован');
            ListLogic::setSession($form->list->id, 'list-active');
            return $this->redirect(['/list/content', 'list_id' => $form->list->id]);
        }   
        return $this->render('form', compact('form', 'item'));
    }
    
    public function actionAdd($obj_id)
    {
        $list_id = ListLogic::getSession('list-active');
        if (!$list_id) {
            Yii::$app->session->setFlash('danger', 'Нет активного списка');
            return $this->redirect(Yii::$app->request->referrer);
        }
        $obj = Objects::getOne($obj_id, false, self::STATUS_ACTIVE);
        $obj->getName();
		$content = new ListContent();
        $content->saveItem($obj, $list_id);
        return $this->redirect(['/list/content', 'list_id' => $list_id]);
    }
     
}