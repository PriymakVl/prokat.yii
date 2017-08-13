<?php

use \yii\helpers\Url;

//$this->registerJsFile('js/order/order_copy.js');
?>
<div  class="sidebar-menu">
    <h5>Список заказов</h5>   
    <ul >
        <li>
            <a href="<?=Url::to(['/order-list/form'])?>">Создать список</a>
        </li>
        <li>
            <a href="<?=Url::to(['/order-list/form', 'list_id' => $list->id])?>">Редактировать список</a>
        </li>
         <li>
            <a href="<?=Url::to(['/order-list/delete', 'list_id' => $list->id])?>">Удалить список</a>
        </li>
        <? if (!$list->active): ?>
            <li>
                <a href="<?=Url::to(['/order-list/active/set', 'list_id' => $list->id])?>">Сделать активным</a>
            </li>
        <? endif; ?>
        <li>
            <a href="" onclick="return false;" id="order-list-copy">Скопировать список</a>
        </li>
        <li>
            <a href="<?=Url::to(['/order-list/print', 'list_id' => $list->id])?>">Отдать на печать</a>
        </li>
    </ul>
</div>