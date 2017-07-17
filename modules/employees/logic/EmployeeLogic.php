<?php

namespace app\modules\employees\logic;

use Yii;
use app\logic\BaseLogic;
use yii\web\ForbiddenHttpException;
use app\modules\employees\models\Employee;

class EmployeeLogic extends BaseLogic
{
	
	 public function behaviors()
    {
    	return ['employee-logic' => ['class' => EmployeeLogic::className()]];
    }
    
    public static function getFullName($id)
    {
		$employee = Employee::getOne($id, null, self::STATUS_ACTIVE);
		if ($employee) return $employee->last.' '.$employee->first.' '.$employee->middle;   
		else return false;
    } 
    
    public static function getShortName($id)
    {
		$employee = Employee::getOne($id, null, self::STATUS_ACTIVE);
		if ($employee) {
			mb_internal_encoding("UTF-8");
			$first = mb_substr($employee->first, 0, 1);
			$middle = mb_substr($employee->middle, 0, 1);
			return $employee->last.' '.$first.'.'.$middle.'.';  
		}
		else return false;   
    }  

}





