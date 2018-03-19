<?php

namespace app\modules\order\widgets;

use Yii;
use yii\base\Widget;
use app\modules\equipments\models\Equipment;

class OrderTopListFiltersWidget extends Widget
{
    public $params;

    public function run()
    {
        $params = $this->params;
        $section_id = Yii::$app->request->get('section');
        $equipment_id = Yii::$app->request->get('equipment');
        $unit_id = Yii::$app->request->get('unit');
        //$types = Tag::findAll(['status' => Tag::STATUS_ACTIVE, 'type' => 'list']);
        $sections = Equipment::getSections();
        if ($section_id) $equipments = Equipment::findAll(['parent_id' => $section_id, 'status' => Equipment::STATUS_ACTIVE]);
        if ($equipment_id) $units = Equipment::findAll(['parent_id' => $equipment_id, 'status' => Equipment::STATUS_ACTIVE]);

        return $this->render('top_list', compact('params', 'sections', 'equipments', 'units', 'section_id', 'equipment_id', 'unit_id'));
    }

}

