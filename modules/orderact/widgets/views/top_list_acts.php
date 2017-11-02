<?php
    use app\modules\orderact\models\OrderAct;
    use yii\helpers\Html;
    
    $this->registerCssFile('/css/orderact.css');
    $this->registerJsFile('/js/orderact/sort_acts.js');

?>
<div class="top-menu top-menu-margin">
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
    <?=Html::dropDownList('year', $params['year'] ? $params['year'] : date('Y'), [2017, 2018, 2019, 2020], ['id' => 'sort-act-year'])?>  
</div>
