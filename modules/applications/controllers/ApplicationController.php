<?php

namespace app\modules\applications\controllers;

use Yii;
use app\controllers\BaseController;
use app\modules\applications\models\Application;
use app\modules\applications\models\ApplicationContent;
use app\modules\applications\forms\ApplicationForm;
use app\modules\applications\logic\ApplicationLogic;

class ApplicationController extends BaseController 
{
    public $layout = "@app/views/layouts/base";
    
    public function actionIndex($app_id) 
    { 
        $app = Application::getOne($app_id, false, self::STATUS_ACTIVE);
        $app->getEnsNumber();
        $session = ApplicationLogic::checkStateSession($app_id, 'app_id'); 
        return $this->render('index', compact('app', 'session'));
    }
    
    public function actionList($year = null, $department = null, $category = null)
    {
        $state = Yii::$app->request->get('state');
        $params = ApplicationLogic::getParams($year, $department, $category, $state);
        $list = Application::getapplicationList($params);
        $pages = Application::$pages;
        return $this->render('list', compact('list', 'params', 'pages', 'state'));
    }
    
    public function actionForm($app_id = null) 
    { 
        $app = Application::getOne($app_id, null, self::STATUS_ACTIVE);
        //if ($app) $app->convertDate($app, false);
        
        $form = new ApplicationForm();
        //$form->getServices($form);
        if($form->load(Yii::$app->request->post()) && $form->validate() && $form->save($app)) { 
            $this->redirect(['/application', 'app_id' => $form->app_id]);
        }   
        return $this->render('form', compact('app', 'form'));
    }
    
    public function actionDelete($app_id)
    {
        $app = application::findOne($app_id);
        $app->deleteOne();
        $this->redirect('/application/list');   
    }
    
    public function actionSetActive($application_id)
    {
        $application = application::findOne(['id' => $application_id]);
        applicationLogic::setSessionActiveapplication($application_id);
        if ((int)$application->number)$this->redirect(['/application', 'application_id' => $application_id]); 
        else $this->redirect(['/application/draft', 'application_id' => $application_id]);
    }
    
    public function actionGetActive()
    {
        $application_id = applicationLogic::getActiveapplicationId();
        $this->redirect(['/application', 'application_id' => $application_id]);
    }
    
    public function actionGetEquipmentForForm()
    {
        $area_id = Yii::$app->request->get('aree_id');
        $equipment = Equipment::getEquipmentOfArea($area_id);
        if (empty($equipment)) return 'error';
        return json_encode($equipment);
    }
    
}