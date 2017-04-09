<?php

use \yii\helpers\Url;
use \yii\web\JqueryAsset;

$this->registerJsFile('js/order/order_list_print.js',  ['depends' => [JqueryAsset::className()]]);
?>
<div  class="sidebar-menu">
    <h5>Список заказов</h5>   
    <ul >
        <li>
            <a href="<?=Url::to(['/order/form'])?>">Выдать заказ</a>
        </li>
        <li>
            <? if ($action == 'list'): ?>
                <a href="<?=Url::to(['/order/drafts/list'])?>">Черновики</a>
            <? elseif ($action == 'drafts-list'): ?>
                <a href="<?=Url::to(['/order/list'])?>">Заказы</a>
            <? endif; ?>
        </li> 
        <li>
            <a href="#" onclick="return false;" id="order-list-print">Распечатать список</a>    
        </li> 
    </ul>
</div>