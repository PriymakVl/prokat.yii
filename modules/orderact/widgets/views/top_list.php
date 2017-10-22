<?php
    use app\modules\orderact\models\OrderAct;
    
    $this->registerCssFile('/css/orderact.css');
    $this->registerJsFile('/js/orderact/sort_acts.js');

?>
<div class="top-menu top-menu-margin">
    <!-- sort state -->
    <label>Состояние:</label>
    <select id="order-act-state">
        <option value="">Все</option>
        <option value="<?=OrderAct::STATE_PROCESSED?>" <? if ($params['state'] == OrderAct::STATE_PROCESSED) echo 'selected'; ?>>В оформлении</option>
        <option value="<?=OrderAct::STATE_CANCELED?>" <? if ($params['state'] == OrderAct::STATE_CANCELED) echo 'selected'; ?>>Отменен</option>
        <option value="<?=OrderAct::STATE_PASSED?>" <? if ($params['state'] == OrderAct::STATE_PASSED) echo 'selected'; ?>>Переданы в ЦРМО</option>
    </select>    
</div>
