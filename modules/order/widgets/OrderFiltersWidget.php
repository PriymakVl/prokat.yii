<?php

namespace app\modules\order\widgets;

use Yii;
use yii\base\Widget;
use app\modules\equipments\models\Equipment;
use app\modules\equipments\models\EquipmentGroup;

class OrderFiltersWidget extends Widget
{
    public $params;

    public function run()
    {
        $params = $this->params;
        $sections = $this->getSections();
        $groups = $this->getGroups();
        //debug($groups['sub']);

        return $this->render('filters/index', compact('params', 'sections', 'groups'));
    }

    private function getSections()
    {
        $sections['sections'] = Equipment::getSections();
        if ($this->params['section']) $sections['equipments'] = Equipment::find()->where(['parent_id' => $this->params['section'], 'status' => Equipment::STATUS_ACTIVE])->orderBy(['rating' => SORT_DESC])->all();
        if ($this->params['equipment']) $sections['units'] = Equipment::find()->where(['parent_id' => $this->params['equipment'], 'status' => Equipment::STATUS_ACTIVE])->orderBy(['rating' => SORT_DESC])->all();
        return $sections;
    }

    private function getGroups()
    {
        $groups['groups'] = EquipmentGroup::getGroups();
        if ($this->params['group']) $groups['sub'] = EquipmentGroup::find()->where(['parent_id' => $this->params['group'], 'status' => EquipmentGroup::STATUS_ACTIVE])->orderBy(['rating' => SORT_DESC])->all();
        if ($this->params['subgroup']) $groups['units'] = EquipmentGroup::find()->where(['parent_id' => $this->params['subgroup'], 'status' => EquipmentGroup::STATUS_ACTIVE])->orderBy(['rating' => SORT_DESC])->all();
        return $groups;
    }

}

