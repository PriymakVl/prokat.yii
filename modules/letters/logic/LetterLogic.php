<?php

namespace app\modules\letters\logic;

use Yii;
use app\logic\BaseLogic;
use yii\web\ForbiddenHttpException;

class LetterLogic extends BaseLogic
{
    
    public static function getParams($to, $state)
    {
        $parans = [];
        $params['status'] = self::STATUS_ACTIVE;
        if ($to && $to != 'all') $params['to'] = $to;
        if ($state && $state != 'all') $params['state'] = $state;
        return $params;   
    }

    


}





