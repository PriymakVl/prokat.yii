<?php

namespace app\modules\search\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\ForbiddenHttpException;
use app\controllers\BaseController;
use app\modules\objects\models\Objects;
use app\modules\drawing\models\DrawingDepartment;
use app\modules\drawing\models\DrawingWorks;
use app\modules\order\models\Order;
use app\modules\order\models\OrderContent;
use app\modules\applications\models\Application;
use app\modules\orderact\logic\OrderActLogic;
use app\modules\orderact\models\OrderAct;

class SearchController extends BaseController 
{
    public $layout = "@app/views/layouts/base";
    
    public function actionCode($code) 
    { 
        $objects = Objects::searchCode($code);
        if (count($objects) == 1) return $this->redirect(['/object', 'obj_id' => $objects[0]->id]);
        else return $this->render('code', ['objects' => $objects, 'code' => $code]);
    }
    
    public function actionDrawingDepartment($number)
    {
        $drawings = DrawingDepartment::find()->where(['number' => $number , 'status' => self::STATUS_ACTIVE])->all();  
        if (count($drawings == 1)) return $this->redirect(['/drawing/department', 'dwg_id' => $drawings[0]->id]);
        if (!$drawings) {
            \Yii::$app->session->setFlash('danger', 'Эскиз с таким номером не найден');
            return $this->redirect(\Yii::$app->request->referrer);        
        } 
        else return $this->render('drafts', ['drawings' => $drawings, 'number' => $number]);
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
    
    public function actionOrderAct($act_num = null, $dwg_num = null)
    {
        if ($act_num) $acts = OrderAct::searchByNumber($act_num);
        else $acts = OrderActLogic::searchByDrawing($dwg_num);
        if (!$acts) {
            $message = $act_num ? 'Акта с таким номером не найдено' : 'Акта с таким чертежом не найдено';
            \Yii::$app->session->setFlash('danger', $message);
            $act_num ? \Yii::$app->session->setFlash('act_num', $act_num) : \Yii::$app->session->setFlash('dwg_num', $dwg_num); 
            return $this->redirect(\Yii::$app->request->referrer);  
        }
        else if (count($acts) == 1) return $this->redirect(['/order/act', 'act_id' => $acts[0]->id]);
        else return $this->render('order_acts', ['acts' => $acts, 'number' => $act_num, 'drawing' => $dwg_num]);
    }
    
    public function actionApplication($out = null, $ens = null)
    {
        if (!$out && !$ens) throw new ForbiddenHttpException('Not search number '.__METHOD__);
        if ($out) $apps = Application::searchByOutNumber($out);
        else $apps = Application::searchByEnsNumber($ens);
        if (count($apps) == 1) return $this->redirect(['/application', 'app_id' => $apps[0]->id]);
        else return $this->render('applications', ['apps' => $apps, 'out' => $out, 'ens' => $ens]);
    }
}