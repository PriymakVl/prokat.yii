<?php

use \yii\helpers\Url;
use app\modules\order\models\Order;

$this->registerJsFile('js/order/order_list_print.js');

?>
<div  class="sidebar-menu">
    <h5>Перечень заказов</h5>   
    <ul >
        <li>
            <a href="<?=Url::to(['/order/form'])?>">Выдать заказ</a>
        </li>
        <li>
            <? if ($state == Order::STATE_DRAFT): ?>
                <a href="<?=Url::to(['/order/list'])?>">Заказы</a>
            <? else: ?>
                <a href="<?=Url::to(['/order/list', 'state' => Order::STATE_DRAFT])?>">Черновики</a>
            <? endif; ?>
        </li> 
        <li>
            <a href="#" onclick="return false;" id="order-list-print">Распечатать перечень</a>    
        </li> 
    </ul>
</div>