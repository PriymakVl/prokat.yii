<?php
use app\modules\order\models\Order;

?>

<!-- filters three line -->
<div class="top-menu top-menu-margin">
    <!-- section select-->
    <label>Участкок:</label>
    <select id="order-section">
        <option value="">Не выбран</option>
        <? foreach ($sections as $section): ?>
            <option value="<?=$section->id?>" <?if($section->id==$section_id)echo'selected';?>><?=$section->name?></option>
        <? endforeach; ?>
    </select>

    <!-- equipments select -->
    <? if ($equipments): ?>
        <label style="margin-left: 5px;">Обор-ние:</label>
        <select id="order-equipment" style="width: 180px;">
            <option value="">Не выбран</option>
            <? foreach ($equipments as $equipment): ?>
                <option value="<?=$equipment->id?>" <?if($equipment->id==$equipment_id)echo'selected';?>><?=$equipment->alias?></option>
            <? endforeach; ?>
        </select>
    <? endif; ?>

    <!-- unit select -->
    <? if ($units): ?>
        <label style="margin-left: 5px;">Узел:</label>
        <select id="order-unit" style="width: 180px;">
            <option value="">Не выбран</option>
            <? foreach ($units as $unit): ?>
                <option value="<?=$unit->id?>" <?if($unit->id==$unit_id)echo'selected';?>><?=$unit->alias?></option>
            <? endforeach; ?>
        </select>
    <? endif; ?>
</div>
