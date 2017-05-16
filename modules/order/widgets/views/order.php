<?php

use \yii\helpers\Url;
use \yii\web\JqueryAsset;

?>
<div  class="sidebar-menu">
    <h5>Заказ</h5>   
    <ul >
        <li>
            <a href="<?=Url::to(['/order/form'])?>">Выдать заказ</a>
        </li>
        <li>
            <a href="<?=Url::to(['/order/form', 'order_id' => $order_id])?>">Редактировать заказ</a>
        </li>
         <li>
            <a href="<?=Url::to(['/order/delete', 'order_id' => $order_id])?>">Удалить заказ</a>
        </li>
        <li>
            <a href="<?=Url::to(['/order/title/sheet/print', 'order_id' => $order_id])?>">Создать титул. лист</a>
        </li>
        <li>
            <a href="<?=Url::to(['/order/content/sheet/print', 'order_id' => $order_id])?>">Создать внутр. лист</a>
        </li>
    </ul>
</div>