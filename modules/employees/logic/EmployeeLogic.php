<?php

namespace app\modules\employees\logic;

use Yii;
use app\logic\BaseLogic;
use yii\web\ForbiddenHttpException;

class EmployeeLogic extends BaseLogic
{
    
    public static function getFullName($employee)
    {
        return $employee->last.' '.$employee->first.' '.$employee->middle;      
    } 
    
    public static function getShortName($employee)
    {
		mb_internal_encoding("UTF-8");
        $first = mb_substr($employee->first, 0, 1);
        $middle = mb_substr($employee->middle, 0, 1);
        return $employee->last.' '.$first.'. '.$middle.'.';      
    }  

}





