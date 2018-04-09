<?php
use app\modules\order\models\Order;

?>

<!-- filters four line -->
<div class="top-menu top-menu-margin">
    <!-- groups select-->
    <label>Участок:</label>
    <select id="order-section">
        <option value="">Не выбран</option>
        <? foreach ($sections['sections'] as $section): ?>
            <option value="<?=$section->id?>" <?if($section->id == $params['section']) echo'selected';?>><?=$section->name?></option>
        <? endforeach; ?>
    </select>

    <!-- sub groups select -->
    <label style="margin-left: 5px;">Обор-ние:</label>
    <select id="order-equipment" style="width: 180px;" <?if (!$sections['equipments']) echo 'disabled';?>>
        <option value="">Не выбран</option>
        <? if ($sections['equipments']): ?>
            <? foreach ($sections['equipments'] as $equipment): ?>
                <option value="<?=$equipment->id?>" <?if($equipment->id == $params['equipment']) echo'selected';?>><?=$equipment->alias?></option>
            <? endforeach; ?>
        <? endif; ?>
    </select>

    <!-- group units select -->
    <label style="margin-left: 5px;">Узел:</label>
    <select id="order-unit" style="width: 180px;" <?if (!$sections['units']) echo 'disabled';?>>
        <option value="">Не выбран</option>
        <? if ($sections['units']): ?>
            <? foreach ($sections['units'] as $unit): ?>
                <option value="<?=$unit->id?>" <?if($unit->id == $params['unit']) echo'selected';?>><?=$unit->alias?></option>
            <? endforeach; ?>
        <? endif; ?>
    </select>
</div>
