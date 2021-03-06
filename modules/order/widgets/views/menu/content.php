<?php

use \yii\helpers\Url;

$this->registerJsFile('/js/order/content_menu/items_delete.js');
$this->registerJsFile('/js/order/content_menu/items_set_parent.js');
//$this->registerJsFile('/js/order/form_add_object.js');
$this->registerJsFile('/js/orderact/order_act_registr.js');
$this->registerJsFile('/js/order/content_menu/content_items_managment.js');
$this->registerJsFile('/js/order/content_menu/item_update.js');
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
                    <a href="<?=Url::to(['/order/content/delete-one', 'item_id' => $item_id])?>">Удалить элемент</a>
                </li>
            <? endif; ?>
        <? else: ?>
            <li>
                <a href="<?=Url::to(['/order/content/form', 'order_id' => $order_id])?>">Добавить элемент</a>
            </li>
            <? if ($controller == 'order-content'): ?>
                <li>
                    <a href="#" onclick="return false;" id="order-items-delete">Удалить элементы</a>
                </li>
                <li>
                    <a href="#" onclick="return false;" id="order-item-update">Редактировать элемент</a>
                </li>
                <li>
                    <a href="#" onclick="return false;" id="order-items-set-parent">Создать сборочный</a>
                </li>
                <li>
                    <a href="#" onclick="return false;" id="order-items-managment">Удалить(добавить) поз.</a>
                </li>
                <li>
                    <a href="#" onclick="return false;" id="order-act-registr">Зарегистрировать акт</a>
                </li>
            <? endif; ?>
        <? endif; ?>
    </ul>
</div>