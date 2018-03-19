<?php
use app\modules\order\models\Order;

?>

<!-- filters one line -->
<div class="top-menu top-menu-margin">
    <!-- sort period -->
    <label>Период:</label>
    <select id="order-period">
        <option value="all">Все</option>
        <option value="4" <? if ($params['period'] == Order::CURRENT_PERIOD) echo 'selected'; ?>>Текущий</option>
        <option value="3" <? if ($params['period'] == Order::PERIOD_2015_2017) echo 'selected'; ?>>с 2015 по 2017</option>
        <option value="2" <? if ($params['period'] == Order::PERIOD_2010_2015) echo 'selected'; ?>>с 2010 по 2015</option>
        <option value="1" <? if ($params['period'] == Order::PERIOD_UNDEFINED) echo 'selected'; ?>>Не определен</option>
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
        <option value="<?=Order::TYPE_MAKING?>" <? if ($params['type'] == Order::TYPE_MAKING) echo 'selected'; ?>>Изготовление</option>
        <option value="<?=Order::TYPE_MAINTENANCE?>" <? if ($params['type'] == Order::TYPE_MAINTENANCE) echo 'selected'; ?>>Тек. ремонт</option>
        <option value="<?=Order::TYPE_CAPITAL_REPAIR?>" <? if ($params['type'] == Order::TYPE_CAPITAL_REPAIR) echo 'selected'; ?>>Кап. ремонт</option>
        <option value="<?=Order::TYPE_ENHANCEMENT?>" <? if ($params['type'] == Order::TYPE_ENHANCEMENT) echo 'selected'; ?>>Улучшение</option>
    </select>
</div>
