<?php

use \yii\helpers\Url;
use \yii\web\JqueryAsset;

?>
<div  class="sidebar-menu">
    <h5>Активный заказ</h5>   
    <ul >
        <? if ($order_id): ?>
            <li>
                <a href="<?=Url::to(['/order/active/set', 'order_id' => $order_id])?>">Сделать активным</a>
            </li>
        <? endif; ?>
         <li>
            <a href="<?=Url::to(['/order/active/get'])?>">Перейти к активному</a>
        </li>
    </ul>
</div>