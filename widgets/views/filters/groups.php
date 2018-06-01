<?php
    $this->registerJsFile('/js/list/filters_group.js');
?>

<div class="top-menu top-menu-margin">
    <!-- groups -->
    <label>Группа:</label>
    <select id="groups">
        <option value="">Не выбрана</option>
        <? foreach ($groups['groups'] as $group): ?>
            <option value="<?=$group->id?>" <? if($group->id == $params['group']) echo'selected';?>><?=$group->alias ? $group->alias : $group->name?></option>
        <? endforeach; ?>
    </select>

    <!-- subgroups -->
    <label style="margin-left: 15px;">Подгруппа:</label>
    <select id="subgroups" style="width: 170px;" <?if (empty($groups['sub'])) echo 'disabled';?>>
        <option value="">Не выбран</option>
        <? if ($groups['sub']): ?>
            <? foreach ($groups['sub'] as $subgroup): ?>
                <option value="<?=$subgroup->id?>" <?if($subgroup->id == $params['subgroup']) echo'selected';?>><?=$subgroup->alias ? $subgroup->alias : $subgroup->name?></option>
            <? endforeach; ?>
        <? endif; ?>
    </select>

    <!-- units subgroup -->
    <label style="margin-left: 15px;">Элемент:</label>
    <select id="units_subgroup" style="width: 170px;" <?if (empty($groups['units'])) echo 'disabled';?>>
        <option value="">Не выбран</option>
        <? if ($groups['units']): ?>
            <? foreach ($groups['units'] as $unit): ?>
                <option value="<?=$unit->id?>" <?if($unit->id == $params['unit_subgroup']) echo'selected';?>><?=$unit->alias ? $unit->alias : $unit->name?></option>
            <? endforeach; ?>
        <? endif; ?>
    </select>
</div>