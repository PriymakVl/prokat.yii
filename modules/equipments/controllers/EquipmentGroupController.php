<?php

namespace app\modules\equipments\controllers;

;
use Yii;
use app\controllers\BaseController;
use app\modules\equipments\models\EquipmentGroup;
use app\modules\equipments\forms\EquipmentGroupForm;
use app\modules\equipments\logic\EquipmentLogic;

class EquipmentGroupController extends BaseController
{
    public $layout = "@app/views/layouts/base";
    /**
    public function actionIndex($order_id) 
    { 
        $order = Order::findOne($order_id);
        $order->getNumber()->convertDate($order)->convertService($order)->convertType()->countWeightOrder();
        $state = OrderLogic::checkState($order_id);
        return $this->render('index', compact('order', 'state'));
    }
	**/
    public function actionForm($item_id = null, $parent_id = null)
    {
        $item = EquipmentGroup::getOne($item_id, null, self::STATUS_ACTIVE);
        if ($item) $parent_id = $item->parent_id;
        $form = new EquipmentGroupForm();
        if($form->load(Yii::$app->request->post()) && $form->validate() && $form->save($item)) {
            $this->redirect(['/equipment/group/list', 'parent_id' => $parent_id]);
        }
        return $this->render('form', compact('item', 'parent_id', 'form'));
    }

	public function actionDelete($item_id)
	{
		$item = EquipmentGroup::findOne($item_id);
		$item->deleteOne();
        return $this->redirect(Yii::$app->request->referrer);
	}

    public function actionList($parent_id = null)
    {
        if ($parent_id) $items = EquipmentGroup::findAll(['parent_id' => $parent_id, 'status' => self::STATUS_ACTIVE]);
        else $items = EquipmentGroup::findAll(['parent_id' => 0, 'status' => self::STATUS_ACTIVE]);
        $breadcrumbs = EquipmentLogic::getBreadcrumbsGroup($parent_id);
        return $this->render('list', compact('items', 'breadcrumbs'));
    }

    public function actionGetSubgroupsAjax()
    {
        $parent_id = \Yii::$app->request->get('group_id');
        $subgroups = EquipmentGroup::getArrayByParentId($parent_id);
        if (empty($subgroups)) return false;
        return json_encode($subgroups);

    }

    public function actionGetSubgroupUnitsAjax()
    {
        $parent_id = \Yii::$app->request->get('subgroup_id');
        $units = EquipmentGroup::getArrayByParentId($parent_id);
        if (empty($units)) return false;
        return json_encode($units);

    }
    

    
}