<?php
use app\modules\order\models\Order;

?>

<!-- filters three line -->
<div class="top-menu top-menu-margin">
    <!-- section select-->
    <label>Группа:</label>
    <select id="order-group">
        <option value="">Не выбрана</option>
        <? foreach ($groups['groups'] as $group): ?>
            <option value="<?=$group->id?>" <? if($group->id == $params['group']) echo'selected';?>><?=$group->alias ? $group->alias : $group->name?></option>
        <? endforeach; ?>
    </select>

    <!-- equipments select -->
        <label style="margin-left: 15px;">Подгруппа:</label>
        <select id="order-subgroup" style="width: 170px;" <?if (empty($groups['sub'])) echo 'disabled';?>>
            <option value="">Не выбран</option>
            <? if ($groups['sub']): ?>
                <? foreach ($groups['sub'] as $subgroup): ?>
                    <option value="<?=$subgroup->id?>" <?if($subgroup->id == $params['subgroup']) echo'selected';?>><?=$subgroup->alias ? $subgroup->alias : $subgroup->name?></option>
                <? endforeach; ?>
            <? endif; ?>
        </select>

    <!-- unit select -->

        <label style="margin-left: 15px;">Элемент:</label>
        <select id="order-group-unit" style="width: 170px;" <?if (empty($groups['units'])) echo 'disabled';?>>
            <option value="">Не выбран</option>
            <? if ($groups['units']): ?>
                <? foreach ($groups['units'] as $unit): ?>
                    <option value="<?=$unit->id?>" <?if($unit->id == $params['unit_subgroup']) echo'selected';?>><?=$unit->alias ? $unit->alias : $unit->name?></option>
                <? endforeach; ?>
            <? endif; ?>
        </select>
</div>
