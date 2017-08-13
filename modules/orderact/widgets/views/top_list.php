<?php
    use app\modules\orderact\models\OrderAct;
    
    $this->registerCssFile('/css/order.css');
    //$this->registerJsFile('js/order/sort_orders.js',  ['depends' => [JqueryAsset::className()]]);
    //debug($params['customer'], false);
?>
<div class="top-menu top-menu-margin">
    <!-- sort state -->
    <label>Состояние:</label>
    <select id="order-act-state">
        <option value="">Все</option>
        <option value="<?=OrderAct::STATE_ACTIVE?>" <? if ($params['state'] == OrderAct::STATE_ACTIVE) echo 'selected'; ?>>В оформлении</option>
        <option value="<?=OrderAct::STATE_CANCELED?>" <? if ($params['state'] == OrderAct::STATE_CANCELED) echo 'selected'; ?>>Удалены</option>
        <option value="<?=OrderAct::STATE_PASSED?>" <? if ($params['state'] == OrderAct::STATE_PASSED) echo 'selected'; ?>>Переданы в ЦРМО</option>
    </select>    
</div>
