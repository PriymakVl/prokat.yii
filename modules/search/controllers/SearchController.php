<?php

namespace app\modules\search\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\ForbiddenHttpException;
use app\controllers\BaseController;
use app\modules\objects\models\Objects;
use app\modules\drawing\models\DrawingDepartment;
use app\modules\drawing\models\DrawingWorks;
use app\modules\order\logic\OrderLogic;
use app\modules\applications\models\Application;
use app\modules\orderact\logic\OrderActLogic;
use app\modules\search\logic\SearchLogic;
use app\modules\orderact\models\OrderAct;

class SearchController extends BaseController 
{
    public $layout = "@app/views/layouts/base";
    
    public function actionObjectCode($code)
    {
        $objects = Objects::searchCode($code);
        if (count($objects) == 1) return $this->redirect(['/object', 'obj_id' => $objects[0]->id]);
        else return $this->render('object_code', ['objects' => $objects, 'code' => $code]);
    }

    public function actionObjectName($name)
    {
        $objects = Objects::searchName($name);
        if (count($objects) == 1) return $this->redirect(['/object', 'obj_id' => $objects[0]->id]);
        else return $this->render('object_name', ['objects' => $objects, 'name' => $name]);
    }
    
    public function actionDrawingDepartment($number)
    {
        $drawings = DrawingDepartment::find()->where(['number' => $number , 'status' => self::STATUS_ACTIVE])->all();  
        if (count($drawings == 1)) return $this->redirect(['/drawing/department', 'dwg_id' => $drawings[0]->id]);
        if (!$drawings) {
            Yii::$app->session->setFlash('danger', 'Эскиз с таким номером не найден');
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
    
    public function actionOrder($order_num = null, $dwg_num = null, $code = null)
    {
        $orders = SearchLogic::searchOrders($order_num, $dwg_num, $code);
        if (!$orders) {
            Yii::$app->session->setFlash('danger', 'Заказ не найден');
            return $this->redirect(Yii::$app->request->referrer);  
        }
        if (count($orders) == 1) return $this->redirect(['/order', 'order_id' => $orders[0]->id]);
        else return $this->render('orders', ['orders' => $orders, 'number' => $order_num, 'drawing' => $dwg_num, 'code' => $code]);
    }
    
    public function actionOrderAct($act_num = null, $dwg_num = null, $code = null)
    {
        $acts = SearchLogic::searchOrderActs($act_num, $dwg_num, $code);
        if (!$acts) {
            if ($act_num) $item = 'номером';
            else if ($dwg_num) $item = 'чертежом';
            else $item = 'кодом детали';
            Yii::$app->session->setFlash('danger', 'Акта с таким '.$item.' не найдено');
            if ($act_num) Yii::$app->session->setFlash('act_num', $act_num);
            else if ($dwg_num) Yii::$app->session->setFlash('dwg_num', $dwg_num); 
            else Yii::$app->session->setFlash('code', $code);
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