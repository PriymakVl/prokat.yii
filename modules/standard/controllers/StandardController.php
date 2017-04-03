<?php

namespace app\modules\standard\controllers;

use Yii;
use yii\helpers\Url;
use app\controllers\BaseController;
use app\models\drawings\Teg;
use app\modules\standard\models\Standard;
use app\modules\drawing\models\forms\StandardForm;

class StandardController extends BaseController 
{
    public $layout = "@app/views/layouts/base";
    
    public function actionIndex($std_id = null) 
    { 
        $std = Standard::findOne($std_id);
        $std->checkChild();
        //if (!$std) die('error modules Standard, controller Standard, method actionIndex');
        if (!$std) $this->showError(__METHOD__);
        
        return $this->render('index', compact('std'));
    }
    
    public function actionList()
    {
        $list = Standard::findAll(['status' => self::STATUS_ACTIVE, 'parent_id' => 0]);
        //debug($list);
        return $this->render('list', compact('list'));
    }
    
    public function actionForm($std_id = null) 
    { 
        $std = (int)$std_id ? Standard::findOne($std_id) : null;
        $form = new StandardDrawingForm();
        
        if($form->load(Yii::$app->request->post()) && $form->validate() && $form->save($std)) { 
            return $this->redirect(['/standard', 'std_id' => $form->std_id]);
        }   
        return $this->render('form', compact('std', 'form'));
    }
    
    public function actionContent($std_id = null) 
    { 
        $parent = Standard::findOne($std_id);
        if (!$parent) $this->showError(__METHOD__);
        
        $children = Standard::findAll(['status' => self::STATUS_ACTIVE, 'parent_id' => $std_id]);
        
        return $this->render('content', compact('parent', 'children'));
    }
    
    public function actionDelete($std_id = null) 
    {
        $std = Standard::findOne($dwg_id);
        if(!$std) exit('error modules Standard, controller StandardController, method actionDelete');
        $dwg->status = self::STATUS_INACTIVE;
        if ($dwg->save()) return $this->redirect(['/standard/list']);
        
    }
    
    public function actionSetParent($ids = null, $parent_id = null)
    {
        if (!$ids || !(int)$parent_id) return 'error';
        
        $ids = explode(',', trim($ids));
        $kit = DrawingStandard::findAll($ids);
        
        foreach ($kit as $dwg) {
            $dwg->parent_id = trim($parent_id);
            $dwg->update();
        } 
        return 'success';   
    }
    
}