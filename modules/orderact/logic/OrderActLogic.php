<?php

namespace app\modules\orderact\logic;

use Yii;
use app\logic\BaseLogic;
use app\modules\orderact\models\OrderAct;
use app\modules\orderact\models\OrderActContent;
use app\modules\order\logic\Orderlogic;
use app\modules\order\models\Order;

class OrderActLogic extends BaseLogic
{

    public static function getParams($month, $year, $state)
    {
        $params['status'] = self::STATUS_ACTIVE;
        $params['month'] = $month ? $month : date('n');
        $params['year'] = $year ? $year : date('Y');
        if ($state) $params['state'] = $state;
        return $params;   
    }
    
    public static function getParamsContent($month, $year, $customer)
    {
        $params['customer'] = $customer;
        $params['month_receipt'] = $month ? $month : date('n');
        $params['year_receipt'] = $year ? $year : date('Y');
        $params['status'] = self::STATUS_ACTIVE;
        return $params;   
    }
    
    public static function convertState($state)
    {
        switch ($state) {
            case OrderAct::STATE_PROCESSED: return '<span style="color:red;">Оформляется</span>';
            case OrderAct::STATE_CANCELED: return '<span style="color:grey;">Анулирован</span>';
            case OrderAct::STATE_PASSED: return '<span style="color:green;">Сдан</span>'; 
        }
    }
    
    public static function convertDepartment($department)
    {
        switch ($department) {
            case 'rem': return 'РМЦ';
            case 'ormo': return 'ОРМО';
            case 'instr': return 'Инструментальное отделение'; 
            default: return $department;
        }    
    }
    
    public static function getPeriod($act)
    {
        if (!$act->month) return false;
        $month = self::getMonthString($act->month, true);
        return $month.' '.$act->year.'г.'; 
    }
    
    public static function editActState($ids)
    {
        $acts = OrderAct::findAll(explode(',', $ids));
        foreach ($acts as $act) {
            $act->state = OrderAct::STATE_PASSED;
            $act->date_pass = time();
            $act->save();
        }
        \Yii::$app->session->setFlash('success', 'Состояние актов успешно отредактировано');
        return true;
    }
    
    public static function deleteActs($ids)
    {
        $acts = OrderAct::findAll(explode(',', $ids));
        if (!$acts) return false;
        foreach ($acts as $act) {
            $act->deleteOne();
            self::deleteActContent($act->id);
        }
        return true;
    }
    
    public static function deleteActContent($act_id)
    {
        $content = OrderActContent::findAll(['act_id' => $act_id]);
        if (!$content) return;
        foreach ($content as $item) {
            $item->deleteOne();
        }
    }
    
    public static function countCostMonth($month = null, $year = null)
    {
        if (!$month) $month = date('m');
        if (!$year) $year = date('Y');
        $acts_all = OrderAct::find()->filterWhere(['month' => $month, 'year' => $year, 'status' => self::STATUS_ACTIVE])->all();
        if (!$acts_all) return false;
        $acts_make = OrderAct::find()->filterWhere(['month' => $month, 'year' => $year, 'status' => self::STATUS_ACTIVE, 'type' => Orderlogic::TYPE_MAKING])->all();
        $acts_current = OrderAct::find()->filterWhere(['month' => $month, 'year' => $year, 'status' => self::STATUS_ACTIVE, 'type' => Orderlogic::TYPE_MAINTENANCE])->all();
        $acts_capital = OrderAct::find()->filterWhere(['month' => $month, 'year' => $year, 'status' => self::STATUS_ACTIVE, 'type' => Orderlogic::TYPE_CAPITAL_REPAIR])->all();
        $acts_enhancement = OrderAct::find()->filterWhere(['month' => $month, 'year' => $year, 'status' => self::STATUS_ACTIVE, 'type' => Orderlogic::TYPE_ENHANCEMENT])->all();
        $costs['all'] = self::countCost($acts_all);
        $costs['make'] = self::countCost($acts_make);
        $costs['current'] = self::countCost($acts_current);
        $costs['capital'] = self::countCost($acts_capital);
        $costs['enhancement'] = self::countCost($acts_enhancement);
        return $costs;
    }
    
    private static function countCost($acts)
    {
        foreach ($acts as $act) {
            if ($act->cost) $total_cost += $act->cost;   
        } 
        return $total_cost;   
    }
    
    //count items for all position act (acts for one order)
    public static function countItemsAct($content)
    {
        $count = 0;
        if (!$content) return $count;
        foreach ($content as $position) {
            $count += $position->count;
        }
        return $count;
    }
    
}





