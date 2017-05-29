<?php

use \yii\helpers\Url;
use \yii\web\JqueryAsset;

$this->registerJsFile('js/order/item_list_delete.js', ['depends' => JqueryAsset::className()]);
$this->registerJsFile('js/order/item_list_set_parent.js', ['depends' => JqueryAsset::className()]);
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
                <a href="<?=Url::to(['/order/content/form', 'order_id' => $order_id])?>">Добавить элемент</a>
            </li>
                <? if ($controller == 'order-content'): ?>
                    <li>
                        <a href="#" id="order-items-delete">Удалить элементы</a>
                    </li>
                    <li>
                        <a href="#" id="order-items-set-parent">Создать сборочный</a>
                    </li>
                <? endif; ?>
        <? endif; ?>
    </ul>
</div>