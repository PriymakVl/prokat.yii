<?php
use app\modules\order\models\Order;

?>

<!-- filters two line -->
<div class="top-menu top-menu-margin">
    <!-- kind -->
    <label>Вид:</label>
    <select id="order-kind">
        <option value="all" <? if (empty($params['kind'])) echo 'selected'; ?>>Все</option>
        <option value="<?=Order::KIND_CURRENT?>" <? if ($params['kind'] == Order::KIND_CURRENT) echo 'selected'; ?>>Разовый</option>
        <option value="<?=Order::KIND_PERMANENT?>" <? if ($params['kind'] == Order::KIND_PERMANENT) echo 'selected'; ?>>Постоянный</option>
        <option value="<?=Order::KIND_ANNUAL?>" <? if ($params['kind'] == Order::KIND_ANNUAL) echo 'selected'; ?>>Годовой</option>
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
