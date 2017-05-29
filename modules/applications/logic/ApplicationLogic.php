<?php

namespace app\modules\applications\logic;

use Yii;
use app\logic\BaseLogic;
use yii\web\ForbiddenHttpException;
use app\modules\applications\models\Application;
use app\modules\applications\models\ApplicationContent;
use app\modules\objects\logic\ObjectLogic;
use app\modules\drawing\logic\DrawingLogic;

class ApplicationLogic extends BaseLogic
{

    public static function getParams($year, $department, $category, $state)
    {
        $parans = [];
        $params['status'] = self::STATUS_ACTIVE;
        //$params['year'] = $year ? $year : date('Y');
        $params['year'] = '2016';
        $state = 'all';
        if ($state != 'all') $params['state'] = $state ? $state : Application::STATE_APP_ACTIVE;
        if ($department && $department != 'all') $params['department'] = $department;
        if ($category && $category != 'all') $params['category'] = $category;
        return $params;   
    }
    
    public static function convertType($type)
    {
        switch($type) {
            case '1' : return 'текущий ремонт'; break;
            case '2' : return 'капитальный ремонт'; break;
            case '3' : return 'улучшение'; break;
        }
    }
    
    public static function setSessionActiveApplication($app_id)
    {
        $session = Yii::$app->session;
        $session->set('app_id', $app_id);
    }
    
    public static function getActiveApplicationId()
    {
        $session = Yii::$app->session;
        $order_id = $session->get('app_id');
        if (!$app_id) throw new ForbiddenHttpException('error active application '. __METHOD__);
        return $app_id;    
    }
    
    

}





