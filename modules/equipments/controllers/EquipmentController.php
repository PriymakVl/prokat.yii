<?php

namespace app\modules\equipments\controllers;

use Yii;
use app\controllers\BaseController;
use app\modules\equipments\models\Equipment;
use app\modules\equipments\forms\EquipmentForm;
use app\modules\equipments\logic\EquipmentLogic;

class EquipmentController extends BaseController 
{
    public $layout = "@app/views/layouts/base";

    public function actionForm($item_id = null, $parent_id = null)
    {
        $item = Equipment::getOne($item_id, null, self::STATUS_ACTIVE);
        if ($item) $parent_id = $item->parent_id;
        $form = new EquipmentForm();
        if($form->load(Yii::$app->request->post()) && $form->validate() && $form->save($item)) {
            $this->redirect(['/equipment/list', 'parent_id' => $parent_id]);
        }
        return $this->render('form', compact('item', 'parent_id', 'form'));
    }

    public function actionDelete($item_id)
    {
        $item = Equipment::findOne($item_id);
        $item->deleteWithHeirs();
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionList($parent_id = null)
    {
        
        if ($parent_id) $items = Equipment::find()->where(['status' => self::STATUS_ACTIVE, 'parent_id' => $parent_id])->orderBy(['rating' => SORT_DESC])->all();
        else $items = Equipment::getSections();
        $breadcrumbs = EquipmentLogic::getBreadcrumbsSection($parent_id);
        return $this->render('list', compact('items', 'breadcrumbs'));
    }

    public function actionGetEquipmentsAjax()
    {
        $parent_id = \Yii::$app->request->get('section_id');
        $equipments = Equipment::getArrayByParentId($parent_id);
        if (empty($equipments)) return false;
        return json_encode($equipments);
    }

    public function actionGetUnitsEquipmentAjax()
    {
        $parent_id = \Yii::$app->request->get('equipment_id');
        $units = Equipment::getArrayByParentId($parent_id);
        if (empty($units)) return false;
        return json_encode($units);
    }
    
   
    
}