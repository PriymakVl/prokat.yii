<?php

namespace app\modules\objects\controllers;

use Yii;
use app\controllers\BaseController;
use app\modules\objects\models\Objects;
use app\modules\objects\logic\ObjectLogic;
use app\modules\objects\forms\ExcelDanieliFileForm;


class ObjectSpecificationController extends BaseController 
{
    public $layout = "@app/views/layouts/base";
    
    public function actionIndex($obj_id)
    {
        $sort = Yii::$app->request->get('sort', 'unit');
        $parent = Objects::getOne($obj_id, false, self::STATUS_ACTIVE);
        $parent->getName();
        $children = Objects::getChildren($parent->id, $sort);
        return $this->render('index', ['parent' => $parent, 'children' => $children, 'sort' => $sort]);
    }
    
//    public function actionMain()
//    {
//        $objects = Objects::getMainParent();
//        return $this->render('main', ['objects' => $objects]);
//    }
    
    public function actionCopyList($ids, $parent_id)
    {
        Objects::copyList($ids, $parent_id);
        $this->redirect(['/object/specification', 'obj_id' => $parent_id]);
    }
    
    //add objects from xml file
    public function actionDanieliFileForm($obj_id) 
    {
        $parent = Objects::getOne($obj_id, false, self::STATUS_ACTIVE);
        $parent->getName();
        $form = new ExcelDanieliFileForm();
        if($form->validate() && $form->save($parent)) {
            return $this->redirect(['/object/specification', 'obj_id' => $parent->id]);
        }  
        
        return $this->render('danieli_form', compact('parent', 'form'));    
    }
    
    public function actionDeleteList($ids, $parent_id)
    {
        Objects::deleteList($ids);
        return $this->redirect(['/object/specification', 'obj_id' => $parent_id]);
    }
    
    public function actionChangeParent($ids, $parent_id)
    {
        Objects::changeParent($ids, $parent_id);
        return $this->redirect(['/object/specification', 'obj_id' => $parent_id]);   
    }
	
	public function actionHighlightList($ids, $parent_id) {
		ObjectLogic::highlightList($ids);
		return $this->redirect(['/object/specification', 'obj_id' => $parent_id]);
	}
    
}