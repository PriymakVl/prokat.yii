<?php

namespace app\modules\search\controllers;

use Yii;
use yii\helpers\Url;
use app\controllers\BaseController;
use app\modules\objects\models\Objects;
use app\modules\drawing\models\DrawingDepartment;
use app\modules\drawing\models\DrawingWorks;
use app\modules\order\models\Order;
use app\modules\order\models\OrderContent;

class SearchController extends BaseController 
{
    public $layout = "@app/views/layouts/base";
    
    public function actionCode($code) 
    { 
        $objects = Objects::searchCode($code);
        if (count($objects) == 1) return $this->redirect(['/object', 'obj_id' => $objects[0]->id]);
        else return $this->render('code', ['objects' => $objects, 'code' => $code]);
    }
    
    public function actionDrawingDepartment($dwg_id)
    {
        $dwg = DrawingDepartment::findOne($dwg_id);  
        if (!$dwg) exit('error class SeachController method actionDrawingdepartment');
        else return $this->redirect(['/drawing/department', 'dwg_id' => $dwg->id]);
    }
    
    public function actionDrawingWorks($number)
    {
        $result = DrawingWorks::find()->where(['status' => Objects::STATUS_ACTIVE])->andWhere(['like', 'number', $number])->all();  
        if (count($result) == 1) return $this->redirect(['/drawing/works', 'dwg_id' => $result[0]->id]);
        
        return $this->render('drawing/works/search/result', ['drawings' => $result, 'number' => $number]);
    }
    
    public function actionOrder($order_num = null, $dwg_num = null)
    {
        if ($order_num) $orders = Order::searchByNumber($order_num);
        else $orders = OrderContent::searchByDrawing($dwg_num);
        if (count($orders) == 1) return $this->redirect(['/order', 'order_id' => $orders[0]->id]);
        else return $this->render('orders', ['orders' => $orders, 'number' => $order_num, 'drawing' => $dwg_num]);
    }
}