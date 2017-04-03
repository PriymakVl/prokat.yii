<?php

namespace app\controllers;

use Yii;
use yii\helpers\Url;
use app\controllers\BaseController;
use app\models\Objects;
use app\models\BaseModel;
use app\models\lists\Lists;
use app\models\lists\ListContent;
use app\models\lists\ListType;
use app\models\forms\ListContentForm;
use app\models\forms\ListTypeForm;


class ListtypeController extends BaseController 
{
    public $layout = 'base';
    
     public function actionIndex()
    {     
        $types = ListType::find()->where(['status' => BaseModel::STATUS_ACTIVE])->all(); 
        return $this->render('index', ['form' => $form, 'list' => $list, 'types' => $types]);    
    }
    
    public function actionDelete($id = NULL) 
    {
        if ((int)$id) $type = ListType::findOne($id); 
        else exit('error method delete'); 

        $type->status = BaseModel::STATUS_INACTIVE;        
        $type->save($item->status);
         
        return $this->redirect(['/listtype']);
    }
    
    public function actionForm($id = NULL) 
    {
        if ((int)$id) $type = ListType::findOne($id); 
        else $type = NULL; 
        
        $form = new ListTypeForm();
        
        if($form->load(Yii::$app->request->post()) && $form->validate()) { 
            $this->saveType($form, $type);
            return Yii::$app->response->redirect(['listtype']);
            exit(0);
        }   
         
        return $this->render('form', compact('form', 'type'));
    }
    
    public function saveType($form, $type)
    {   
        if (!$type) $type = new ListType();
        $type->name = $form->name;
        $type->value = $form->value;
        $type->save();
        return true;           
    }
    
    
}