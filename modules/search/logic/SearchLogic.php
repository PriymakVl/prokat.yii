<?php

namespace app\modules\search\logic;

use Yii;
use app\logic\BaseLogic;
use yii\web\ForbiddenHttpException;
use app\modules\order\models\Order;
use app\modules\order\models\OrderContent;
use app\modules\order\logic\OrderLogic;
use app\modules\objects\models\Objects;
use app\modules\orderact\models\OrderAct;
use app\modules\orderact\models\OrderActContent;
use app\modules\objects\logic\ObjectLogic;
use app\modules\drawing\logic\DrawingLogic;
use app\modules\equipments\models\Equipment;

class SearchLogic extends BaseLogic
{
    
    public static function searchOrders($order = null, $dwg = null, $code = null)
    {
        if ($order) return Order::findAll(['number' => $order, 'status' => self::STATUS_ACTIVE]);
        $column = $dwg ? 'drawing' : 'code';
        $result = OrderContent::find()->where(['status' => STATUS_ACTIVE])->filterWhere(['like', $column, $dwg ? $dwg : $code])->all();
        if (empty($result)) return [];
        if (count($result) == 1) $orders = Order::findAll(['id' => $result[0]->order_id]);
        else $orders = OrderLogic::getArrayOrders($result);
        self::executeMethods($orders, ['getNumber']);
        return $orders;
    }
    
    public static function searchOrderActs($act, $dwg, $code)
    {
        if ($act) {
            $acts = OrderAct::findAll(['number' => $act, 'status' => self::STATUS_ACTIVE]);
            return self::executeMethods($acts, ['getOrder', 'getPeriod', 'convertDepartment']);
        }
        else {
            $acts = [];
            if ($dwg) $items = OrderActContent::find()->where(['status' => STATUS_ACTIVE])->filterWhere(['like', 'drawing', $dwg ? $dwg : $dwg])->all();
            else $items = OrderActContent::find()->where(['status' => STATUS_ACTIVE])->filterWhere(['like', 'code', $code ? $code : $code])->all();
            if (!$items) return $acts;
            foreach ($items as $item) {
                $act = OrderAct::findOne($item->act_id);
                $act->getOrder()->getPeriod()->convertDepartment();
                $acts[] = $act;
            }
            return $acts;    
        }
    }

}





