<?php
    use yii\web\JqueryAsset;
    
    $this->registerCssFile('/css/order.css');
    $this->registerJsFile('js/order/sort_orders.js',  ['depends' => [JqueryAsset::className()]]);
    //debug($params['customer'], false);
?>
<div class="top-menu top-menu-margin">
    <!-- sort period -->
    <label>Период:</label>
    <select id="order-period">
        <option value="all">Все</option>
        <option value="4" <? if ($params['period'] == 4) echo 'selected'; ?>>Текущий</option>
        <option value="3" <? if ($params['period'] == 3) echo 'selected'; ?>>с 2015 по 2017</option>
        <option value="2" <? if ($params['period'] == 2) echo 'selected'; ?>>с 2010 по 2015</option>
		<option value="1" <? if ($params['period'] == 1) echo 'selected'; ?>>Не определен</option>
    </select>

    <!-- sort customer -->
     <label>Заказал:</label>
    <select id="order-customer">
        <option value="all">Все</option>
        <option value="1" <? if ($params['customer'] == 1) echo 'selected'; ?>>Костырко В.Н.</option>
        <option value="2" <? if ($params['customer'] == 2) echo 'selected'; ?>>Саенко А.И.</option>
		<option value="4" <? if ($params['customer'] == 4) echo 'selected'; ?>>Волковский С.В.</option>
        <option value="7" <? if ($params['customer'] == 7) echo 'selected'; ?>>Станиславский О.В.</option>
        <option value="8" <? if ($params['customer'] == 8) echo 'selected'; ?>>Коваль А.П.</option>
        <option value="8" <? if ($params['customer'] == 9) echo 'selected'; ?>>Пасюк В.В.</option>
    </select>
    
    <!-- sort tags -->
    <label>Участки:</label>
    <select id="order-tag">
        <option value="all">Все</option>
        <? foreach ($tags as $key => $value): ?>
            <option value="<?=$key?>" <? if ($params['tag'] == $key) echo 'selected'; ?>><?=$value?></option>   
        <? endforeach; ?>
    </select>
</div>
