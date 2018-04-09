<?php
$this->registerJsFile('/js/order/form_order_get_equipment.js');
$this->registerJsFile('/js/order/form_order_get_group_equ.js');
?>
<div id="order-form-filters" style="display: none;"><!-- filters-tab -->

    <div class="sections-equipment-wrp">
        <!-- sections -->
        <div id="sections-wrp">
            <label>Участок:</label>
            <select id="orderform-sections" name="OrderForm[section]" class="form-control">
                <option value="" selected="selected">Не выбран</option>
                <? foreach ($form->sections as $section): ?>
                    <option value="<?=$section->id?>" <? if ($section->id == $order->section) echo 'selected'; ?> ><?=$section->alias ? $section-> alias : $section->name?></option>
                <? endforeach; ?>
            </select>
        </div>

        <!-- equipments -->
        <div id="section-equipments-wrp">
            <label>Агрегат, механизм:</label>
            <select id="section-equipments" <? if (!$form->equipments) echo 'disabled="disabled"'; ?> name="OrderForm[equipment]" class="form-control">
                <option name_equ="">Не выбран</option>
                <? if ($form->equipments): ?>
                    <? foreach ($form->equipments as $equipment): ?>
                        <option value="<?=$equipment->id?>" <? if ($equipment->id == $order->equipment) echo 'selected'; ?>  ><?=$equipment->alias ? $equipment->alias : $equipment->name?></option>
                    <? endforeach; ?>
                <? endif; ?>
            </select>
        </div>

        <!-- units of equipment -->
        <div id="equipment-units-wrp">
            <label>Узел:</label>
            <select id="equipment-units" <? if (!$form->units) echo 'disabled="disabled"'; ?> name="OrderForm[unit]" class="form-control">
                <option name_unit="">Не выбран</option>
                <? if ($form->units): ?>
                    <? foreach ($form->units as $unit): ?>
                        <option value="<?=$unit->id?>" <? if ($unit->id == $order->unit) echo 'selected'; ?>><?=$unit->alias ? $unit->alias : $unit->name?></option>
                    <? endforeach; ?>
                <? endif; ?>
            </select>
        </div>
    </div><!-- sections-equipments-wrp -->

    <div class="groups-subgroups-wrp">
        <!-- sections -->
        <div id="groups-wrp">
            <label>Группа:</label>
            <select id="orderform-groups" name="OrderForm[group]" class="form-control">
                <option value="" selected="selected">Не выбрана</option>
                <? foreach ($form->groups as $group): ?>
                    <option value="<?=$group->id?>" <? if ($group->id == $order->group) echo 'selected'; ?>><?=$group->alias ? $group->alias : $group->name?></option>
                <? endforeach; ?>
            </select>
        </div>

        <!-- subgroups -->
        <div id="subgroups-wrp">
            <label>Подгруппа:</label>
            <select id="orderform-subgroups" <? if (!$form->subgroups) echo 'disabled="disabled"'; ?> name="OrderForm[subgroup]" class="form-control">
                <option value="">Не выбрана</option>
                <? if ($form->subgroups): ?>
                    <? foreach ($form->subgroups as $subgroup): ?>
                        <option value="<?=$subgroup->id?>" <? if ($subgroup->id == $order->subgroup) echo 'selected'; ?>><?=$subgroup->alias ? $subgroup->alias : $subgroup->name?></option>
                    <? endforeach; ?>
                <? endif; ?>
            </select>
        </div>

        <!-- units of groups -->
        <div id="subgroup-units-wrp">
            <label>Элемент подгруппы:</label>
            <select id="orderform-subgroup-units" <? if (!$form->units) echo 'disabled="disabled"'; ?> name="OrderForm[unitSubgroup]" class="form-control">
                <option name_unit="">Не выбраны</option>
                <? if ($form->unitsSubgroup): ?>
                    <? foreach ($form->unitsSubgroup as $unit): ?>
                        <option value="<?=$unit->id?>" <? if ($unit->id == $order->unit_subgroup) echo 'selected'; ?>><?=$unit->alias ? $unit->alias : $unit->name?></option>
                    <? endforeach; ?>
                <? endif; ?>
            </select>
        </div>

    </div>
</div><!-- filters tab end -->