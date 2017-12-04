<?php
    use app\modules\order\logic\OrderLogic;
    use app\modules\order\models\Order;
    
    $this->registerCssFile('/css/order.css');
    $this->registerJsFile('/js/order/sort_orders.js');
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
        <option value="9" <? if ($params['customer'] == 9) echo 'selected'; ?>>Пасюк В.В.</option>
    </select>
    
    <!-- type -->
    <label>Тип:</label>
    <select id="order-type">
        <option value="">Все</option>
        <option value="<?=Orderlogic::TYPE_MAKING?>" <? if ($params['type'] == Orderlogic::TYPE_MAKING) echo 'selected'; ?>>Изготовление</option>
        <option value="<?=Orderlogic::TYPE_MAINTENANCE?>" <? if ($params['type'] == Orderlogic::TYPE_MAINTENANCE) echo 'selected'; ?>>Тек. ремонт</option>
		<option value="<?=Orderlogic::TYPE_CAPITAL_REPAIR?>" <? if ($params['type'] == Orderlogic::TYPE_CAPITAL_REPAIR) echo 'selected'; ?>>Кап. ремонт</option>
        <option value="<?=Orderlogic::TYPE_ENHANCEMENT?>" <? if ($params['type'] == Orderlogic::TYPE_ENHANCEMENT) echo 'selected'; ?>>Улучшение</option>
    </select>
    
    <!-- kind -->
    <label>Вид:</label>
    <select id="order-kind">
        <option value="all" <? if (empty($params['kind'])) echo 'selected'; ?>>Все</option>
        <option value="<?=Order::KIND_CURRENT?>" <? if ($params['kind'] == Order::KIND_CURRENT) echo 'selected'; ?>>Разовые</option>
        <option value="<?=Order::KIND_PERMANENT?>" <? if ($params['kind'] == Order::KIND_PERMANENT) echo 'selected'; ?>>Постоянные</option>
    </select>
    
    <!-- state -->
    <label>Состояние:</label>
    <select id="order-state">
        <option value="all" <? if (empty($params['state'])) echo 'selected'; ?>>Все</option>
        <option value="<?=Order::STATE_ACTIVE?>" <? if ($params['state'] == Order::STATE_ACTIVE) echo 'selected'; ?>>Выданы</option>
        <option value="<?=Order::STATE_DRAFT?>" <? if ($params['state'] == Order::STATE_DRAFT) echo 'selected'; ?>>Черновики</option>
        <option value="<?=Order::STATE_CLOSED?>" <? if ($params['state'] == Order::STATE_CLOSED) echo 'selected'; ?>>Закрытые</option>
		<option value="<?=Order::STATE_NOT_ACCEPTED?>" <? if ($params['state'] == Order::STATE_NOT_ACCEPTED) echo 'selected'; ?>>Не приняты</option>
    </select>
        
</div>
