<?php
    use app\modules\orderlist\models\OrderList;
    
    $this->registerCssFile('/css/order_list.css');
    //$this->registerJsFile('js/order/sort_orders.js',  ['depends' => [JqueryAsset::className()]]);
    //debug($params['customer'], false);
?>
<div class="top-menu top-menu-margin">
    <!-- type -->
    <label>Тип:</label>
    <select id="order-list-type">
        <option value="">Все</option>
        <option value="<?=OrderList::TYPE_LETTER?>" <? if ($params['type'] == OrderList::TYPE_LETTER) echo 'selected'; ?>>Письма</option>
        <option value="<?=OrderList::TYPE_MONTH?>" <? if ($params['type'] == OrderList::TYPE_MONTH) echo 'selected'; ?>>Планы на месяц</option>
        <option value="<?=OrderList::TYPE_CAPITAL?>" <? if ($params['type'] == OrderList::TYPE_CAPITAL) echo 'selected'; ?>>Капитальные ремонты</option>
		<option value="<?=OrderList::TYPE_OTHER?>" <? if ($params['type'] == OrderList::TYPE_OTHER) echo 'selected'; ?>>Разное</option>
    </select>
</div>
