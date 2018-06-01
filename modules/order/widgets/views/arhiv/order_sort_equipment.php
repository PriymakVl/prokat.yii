<?php

//$this->registerJsFile('/js/order/order_sort_equipment.js');

?>

<!-- sort equipment menu-->
<div  class="sidebar-menu">
    <h5>Сортировка заказов</h5>
    
    <!-- section select-->
    <div class="dropdown-menu-wrp">
        <label>Участки:</label>
        <select id="order-section">
            <option value="">Не выбран</option>
            <? foreach ($sections as $section): ?>
                <option value="<?=$section->id?>" <?if($section->id==$section_id)echo'selected';?>><?=$section->name?></option>
            <? endforeach; ?>
        </select>
    </div>
    
    <!-- equipments select -->
    <? if ($equipments): ?>
        <div class="dropdown-menu-wrp">
            <label>Агрегаты, механизмы:</label>
            <select id="order-equipment" style="width: 180px;">
                <option value="">Не выбран</option>
                <? foreach ($equipments as $equipment): ?>
                    <option value="<?=$equipment->id?>" <?if($equipment->id==$equipment_id)echo'selected';?>><?=$equipment->alias?></option>
                <? endforeach; ?>
            </select>
        </div>
    <? endif; ?>
    
    <!-- unit select -->
    <? if ($units): ?>
        <div class="dropdown-menu-wrp">
            <label>Узлы:</label>
            <select id="order-unit" style="width: 180px;">
                <option value="">Не выбран</option>
                <? foreach ($units as $unit): ?>
                    <option value="<?=$unit->id?>" <?if($unit->id==$unit_id)echo'selected';?>><?=$unit->alias?></option>
                <? endforeach; ?>
            </select>
        </div>
    <? endif; ?>
</div>