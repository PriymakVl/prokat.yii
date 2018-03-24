<?php

namespace app\modules\order\widgets;

use Yii;
use yii\base\Widget;
use app\modules\equipments\models\Equipment;
use app\modules\equipments\models\EquipmentGroup;

class OrderTopListFiltersWidget extends Widget
{
    public $params;

    public function run()
    {
        $params = $this->params;
        $sections = $this->getSections();
        $groups = $this->getGroups();

        return $this->render('top_list', compact('params', 'sections', 'groups'));
    }

    private function getSections()
    {
        $sections['sections'] = Equipment::getSections();
        if ($this->params['section']) $sections['equipments'] = Equipment::findAll(['parent_id' => $this->params['section'], 'status' => Equipment::STATUS_ACTIVE]);
        if ($this->params['equipment']) $sections['units'] = Equipment::findAll(['parent_id' => $this->params['equipment'], 'status' => Equipment::STATUS_ACTIVE]);
        return $sections;
    }

    private function getGroups()
    {
        $groups['groups'] = EquipmentGroup::getGroups();
        if ($this->params['group']) $groups['sub'] = EquipmentGroup::findAll(['parent_id' => $this->params['group'], 'status' => EquipmentGroup::STATUS_ACTIVE]);
        if ($this->params['subgroup']) $groups['units'] = EquipmentGroup::findAll(['parent_id' => $this->params['subgroup'], 'status' => EquipmentGroup::STATUS_ACTIVE]);
        return $groups;
    }

}

