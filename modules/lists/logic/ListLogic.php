<?php

namespace app\modules\lists\logic;

use Yii;
use app\logic\BaseLogic;



class ListLogic extends BaseLogic
{
    
    const DEFAULT_LIST_ID = 7;

    public static function getListId()
    {
        $session = Yii::$app->session;
        return $session->get('list_id') ? $session->get('list_id') : self::DEFAULT_LIST_ID; 
    }
    
    public static function getParams()
    {
        $params = [];
        if (self::in_get('type')) $params['type'] = Yii::$app->request->get('type');
        $params['status'] = self::STATUS_ACTIVE;
        return $params;
    }
    
    public static function setSessionActiveList($list_id)
    {
        //if (!(int)$list_id) throw new ForbiddenHttpException('error list_id '.__METHOD__);
        $session = Yii::$app->session;
        $session->set('list_id', $list_id);
    }
    
    public static function deleteListFromSession()
    {
        $session = Yii::$app->session;
        $session->remove('list_id');
    }
    
    public static function getActiveListId()
    {
        $session = Yii::$app->session;
        $list_id = $session->get('list_id');
        if (!$list_id) throw new ForbiddenHttpException('�� ������ �������� ������ '.__METHOD__);
        return $list_id;
    }
    
    
    


}





