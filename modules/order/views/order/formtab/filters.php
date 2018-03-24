<div id="order-form-filters" ><!-- filters-tab -->

    <div class="sections-equipment-wrp">
        <!-- sections -->
        <div id="sections-wrp">
            <label>Участки:</label>
            <select id="orderform-sections" name="OrderForm[section]" class="form-control">
                <option value="" selected="selected">Не выбран</option>
                <? foreach ($form->sections as $section): ?>
                    <option value="<?=$section->id?>" <? if ($section->id == $order->section) echo 'selected'; ?> alias="<?=$section->alias?>"><?=$section->name?></option>
                <? endforeach; ?>
            </select>
        </div>

        <!-- equipments -->
        <div id="section-equipments-wrp">
            <label>Агрегаты, механизмы:</label>
            <select id="section-equipments" <? if (!$form->equipments) echo 'disabled="disabled"'; ?> class="form-control">
                <option name_equ="">Не выбран</option>
                <? if ($form->equipments): ?>
                    <? foreach ($form->equipments as $equipment): ?>
                        <option value="<?=$equipment['alias']?>" <? if ($equipment['id'] == $order->equipment) echo 'selected'; ?> inventory="<?=$equpment['inventory']?>" name_equ="<?=$equpment['name']?>" equipment_id="<?=$equipment['id']?>"><?=$equipment['name']?></option>
                    <? endforeach; ?>
                <? endif; ?>
            </select>
        </div>

        <!-- units of equipment -->
        <div id="equipment-units-wrp">
            <label>Узлы:</label>
            <select id="equipment-units" <? if (!$form->units) echo 'disabled="disabled"'; ?> class="form-control">
                <option name_unit="">Не выбран</option>
                <? if ($form->units): ?>
                    <? foreach ($form->units as $unit): ?>
                        <option value="<?=$unit['alias']?>" <? if ($unit['id'] == $order->unit) echo 'selected'; ?> name_unit="<?=$unit['name']?>" unit_id="<?=$unit['id']?>"><?=$unit['name']?></option>
                    <? endforeach; ?>
                <? endif; ?>
            </select>
        </div>

        <!-- equipment field-->
        <?=$f->field($form, 'equipment')->textInput(['value' => $order->equipmentName, 'style' => 'width:300px'])->label('Агрегат (сортировка):')?>

        <!-- unit equipment field-->
    <?=$f->field($form, 'unit')->textInput(['value' => $order->unitName, 'style' => 'width:300px'])->label('Узел (сортировка):')?>
    </div><!-- sections-equipments-wrp -->

    <div class="groups-subgroups-wrp">
        <!-- sections -->
        <div id="groups-wrp">
            <label>Группы:</label>
            <select id="orderform-groups" name="OrderForm[group]" class="form-control">
                <option value="" selected="selected">Не выбрана</option>
                <? foreach ($form->groups as $group): ?>
                    <option value="<?=$group->id?>" <? if ($group->id == $order->group) echo 'selected'; ?> alias="<?=$group->alias?>"><?=$group->name?></option>
                <? endforeach; ?>
            </select>
        </div>

        <!-- subgroups -->
        <div id="subgroups-wrp">
            <label>Подгруппы:</label>
            <select id="orderform-subgroups" <? if (!$form->subgroups) echo 'disabled="disabled"'; ?> class="form-control">
                <option value="">Не выбрана</option>
                <? if ($form->subgroups): ?>
                    <? foreach ($form->subgroups as $subgroup): ?>
                        <option value="<?=$subgroup['alias']?>" <? if ($subgroup['id'] == $order->subgroup) echo 'selected'; ?> name_subgroup="<?=$subgroup['name']?>" subgroup_id="<?=$subgroup['id']?>"><?=$subgroup['name']?></option>
                    <? endforeach; ?>
                <? endif; ?>
            </select>
        </div>

        <!-- units of groups -->
        <div id="subgroup-units-wrp">
            <label>Узлы подгруппы:</label>
            <select id="orderform-subgroup-units" <? if (!$form->units) echo 'disabled="disabled"'; ?> class="form-control">
                <option name_unit="">Не выбраны</option>
                <? if ($form->unitsSubgroup): ?>
                    <? foreach ($form->unitsSubgroup as $unit): ?>
                        <option value="<?=$unit['alias']?>" <? if ($unit['id'] == $order->unit_subgroup) echo 'selected'; ?> name_unit_subgroup="<?=$unit['name']?>" unit_group_id="<?=$unit['id']?>"><?=$unit['name']?></option>
                    <? endforeach; ?>
                <? endif; ?>
            </select>
        </div>

        <!-- equipment field-->
        <?=$f->field($form, 'subgroup')->textInput(['value' => $order->subgroup, 'style' => 'width:300px'])->label('Подгруппа:')?>

        <!-- unit equipment field-->
        <?=$f->field($form, 'unit_subgroup')->textInput(['value' => $order->unit_subgroup, 'style' => 'width:300px'])->label('Узел подгруппы:')?>
    </div><!-- sections-equipments-wrp -->
</div><!-- filters tab end -->