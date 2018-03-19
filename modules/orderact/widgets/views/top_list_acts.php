<?php
    use app\modules\orderact\models\OrderAct;
    use app\modules\order\models\Order;
    use yii\helpers\Html;
    
    $this->registerCssFile('/css/orderact.css');
    $this->registerJsFile('/js/orderact/sort_acts.js');

?>
<div class="top-menu top-menu-margin <?=$filters?'':'hidden'?>">
    <!-- sort state -->
    <label>Состояние:</label>
    <select id="sort-act-state">
        <option value="">Все</option>
        <option value="<?=OrderAct::STATE_PROCESSED?>" <? if ($params['state'] == OrderAct::STATE_PROCESSED) echo 'selected'; ?>>В оформлении</option>
        <option value="<?=OrderAct::STATE_CANCELED?>" <? if ($params['state'] == OrderAct::STATE_CANCELED) echo 'selected'; ?>>Отменен</option>
        <option value="<?=OrderAct::STATE_PASSED?>" <? if ($params['state'] == OrderAct::STATE_PASSED) echo 'selected'; ?>>Переданы в ЦРМО</option>
    </select> 
    
    <!-- sort month -->
    <label style="margin-left:15px;">Месяц:</label>
    <?=Html::dropDownList('month', $params['month'] ? $params['month'] : date('m'), $months, ['id' => 'sort-act-month'])?>  
    
    <!-- sort year -->
    <label style="margin-left:15px;">Год:</label>
    <?=Html::dropDownList('year', $params['year'] ? $params['year'] : date('Y'), ['2017' => 2017, '2018' => 2018, '2019' => 2019, '2020' => 2020], ['id' => 'sort-act-year'])?>

    <!-- type -->
    <label style="margin-left: 20px;">Тип:</label>
    <select id="sort-act-type">
        <option value="">Все</option>
        <option value="<?=Order::TYPE_MAKING?>" <? if ($params['type'] == Order::TYPE_MAKING) echo 'selected'; ?>>Изготовление</option>
        <option value="<?=Order::TYPE_MAINTENANCE?>" <? if ($params['type'] == Order::TYPE_MAINTENANCE) echo 'selected'; ?>>Тек. ремонт</option>
        <option value="<?=Order::TYPE_CAPITAL_REPAIR?>" <? if ($params['type'] == Order::TYPE_CAPITAL_REPAIR) echo 'selected'; ?>>Кап. ремонт</option>
        <option value="<?=Order::TYPE_ENHANCEMENT?>" <? if ($params['type'] == Order::TYPE_ENHANCEMENT) echo 'selected'; ?>>Улучшение</option>
    </select>
</div>

<div class="top-menu top-menu-margin <?=$filters?'':'hidden'?>">
    <!-- sort customer -->
    <label>Заказал:</label>
    <select id="sort-act-customer">
        <option value="">Все</option>
        <option value="1" <? if ($params['customer'] == 1) echo 'selected'; ?>>Костырко В.Н.</option>
        <option value="2" <? if ($params['customer'] == 2) echo 'selected'; ?>>Саенко А.И.</option>
        <option value="4" <? if ($params['customer'] == 4) echo 'selected'; ?>>Волковский С.В.</option>
        <option value="7" <? if ($params['customer'] == 7) echo 'selected'; ?>>Станиславский О.В.</option>
        <option value="8" <? if ($params['customer'] == 8) echo 'selected'; ?>>Коваль А.П.</option>
        <option value="9" <? if ($params['customer'] == 9) echo 'selected'; ?>>Пасюк В.В.</option>
    </select>

    <!-- department -->
    <?php
        echo "<label style='margin-left: 20px'>Участок:</label>";
        $departments = ['' => 'Все', 'rem' => 'РМЦ', 'ormo' => 'ОРМО', 'instr' => 'Инструментальное отделение', 'smk' => 'Участок металлоконструкций',
            'foundry' => 'Литейное отделение', 'hammer' => 'Кузнечное отделение'];
        echo Html::dropDownList('department', $params['department'], $departments, ['id' => 'sort-act-department', 'style' => 'width:180px']);
    ?>
</div>

