<?php

use \yii\helpers\Url;
use \yii\web\JqueryAsset;

?>
<div  class="sidebar-menu">
    <h5><?=$action == 'index' ? 'Элемент заказа' : 'Элементы заказа'?></h5>   
    <ul >
        <? if ($action == 'index'): ?>
            <li>
                <a href="<?=Url::to(['/order/content/form', 'order_id' => $order_id])?>">Добавить элемент</a>
            </li>
            <? if ($item_id): ?>
                <li>
                    <a href="<?=Url::to(['/order/content/form', 'item_id' => $item_id, 'order_id' => $order_id])?>">Редактировать элемент</a>
                </li>
                <li>
                    <a href="<?=Url::to(['/order/content/item/delete', 'item_id' => $item_id])?>">Удалить элемент</a>
                </li>
            <? endif; ?>
        <? else: ?>
            <li>
                <a href="#" id="order-items-delete">Удалить элементы</a>
            </li>
        <? endif; ?>
    </ul>
</div>