<?php

use \yii\helpers\Url;
use \yii\web\JqueryAsset;

?>
<? if ($order_id != $active_id): ?>
    <div  class="sidebar-menu">
        <h5>Активный заказ</h5>   
        <ul >
            <? if ($active_id): ?>
                 <li>
                    <a href="<?=Url::to(['/order', 'order_id' => $active_id])?>">Перейти к активному</a>
                </li>
            <? endif; ?>
            <li>
                <a href="<?=Url::to(['/order/active/set', 'order_id' => $order_id])?>">Сделать активным</a>
            </li>
        </ul>
    </div>
<? endif; ?>