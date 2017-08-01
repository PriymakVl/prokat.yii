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
        $params['year'] = $year ? $year : date('Y');
        $state = 'all';
        if ($state != 'all') $params['state'] = $state ? $state : Application::STATE_APP_ACTIVE;
        if ($department) $params['department'] = $department;
        if ($category && $category != 'all') $params['category'] = $category;
        return $params;   
    }
    
    public static function convertType($type)
    {
        switch($type) {
            case 'current' : return 'Текущий'; break;
            case 'capital' : return 'Капитальный'; break;
            case 'improvement' : return 'Улучшение'; break;
            default : return 'Не указан';
        }
    }
    
    public static function convertPeriod($period)
    {
        switch($period) {
            case 'year' : return 'Годовая'; break;
            case 'month' : return 'Месячная'; break;
            default : return 'Не указана';
        }
    }
    
    public static function convertState($state)
    {
        switch($state) {
            case Application::STATE_APP_ACTIVE : return 'Принята'; break;
            case Application::STATE_APP_DRAFT : return '<span style="color:red">Черновик</span>'; break;
            case Application::STATE_APP_CREATE : return '<span style="color:red">Создана</span>'; break;
            default : return 'Не указано';
        }
    }
    
    public static function convertDepartment($department, $full)
    {
        switch($department) {
            case 'supply' : return $full ? 'Отдел снабжения' : 'ОМТС'; break;
            case 'equipment' : return $full ? 'Отдел оборудования' : 'ОО'; break;
            default : return 'Не указана';
        }
    }
    
    public static function convertCategory($category)
    {
        switch($category) {
            case "tool" : return 'Инструмент'; break;
            case "mill" : return 'Оборудование и запчасти для стана'; break;
            case "finish" : return 'Оборудование и запчасти для отделки'; break;
            case "crane" : return 'Оборудование и запчасти для ГПМ'; break;
            case "sort" : return 'Оборудование и запчасти для сортовой линии'; break;
            case "bunt" : return 'Оборудование и запчасти для бунтовой линии'; break;
            case "gydra" : return 'Эапчасти для гидр. оборудования'; break;
            case "sundbirsta" : return 'Оборудование и запчасти для Sundbirsta'; break;
            case "bearings" : return 'Подшипники'; break;
            case "lubricants" : return 'Горюче смазочные материалы'; break;
            case "material" : return 'Материалы'; break;
            case "rubber" : return 'Резино технические изделия'; break;
            case "welding" : return 'Сварка'; break;
            case "stationery" : return 'Канц.товары'; break;
            default : return 'Не указана';
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





