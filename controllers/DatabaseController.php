<?php
namespace app\controllers;
use Yii;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\controllers\BaseController;
use app\models\Objects;
use app\modules\applications\models\Application;
use app\modules\applications\models\Applicationold;

class DatabaseController extends BaseController 
{
    public function actionIndex()
    {
        //$app_new = Application::findAll();
        $app_old = Applicationold::getAll();
        
        foreach ($app_old as $app) {
            $app_new = Application::findOne(['id' => $app->id]);
            //debug($app->type_repair);
   //         if ($app->type_repair == 'Капитальный') {
//                $app_new->type_repair = 'capital';
//                debug($app_new);
//            }
//            else if ($app->type_repair == 'Текущий') {
//                $app_new->type_repair = 'current';
//            }
            //$app_new->save();
            echo '<p>'.$app->type_repair.'</p>';
        }
        die('end');
    }
    
}