<?php

namespace app\widgets;

use yii\base\Widget;
use app\modules\equipments\models\EquipmentGroup;

class FiltersGroupWidget extends Widget
{
    public $params;

    public function run()
    {
        $params = $this->params;
        $groups = $this->getGroups();
        return $this->render('filters/groups', compact('groups', 'params'));
    }

    private function getGroups()
    {
        $groups['groups'] = EquipmentGroup::getGroups();
        if ($this->params['group']) $groups['sub'] = EquipmentGroup::find()->where(['parent_id' => $this->params['group'], 'status' => EquipmentGroup::STATUS_ACTIVE])->orderBy(['rating' => SORT_DESC])->all();
        if ($this->params['subgroup']) $groups['units'] = EquipmentGroup::find()->where(['parent_id' => $this->params['subgroup'], 'status' => EquipmentGroup::STATUS_ACTIVE])->orderBy(['rating' => SORT_DESC])->all();
        return $groups;
    }

}

