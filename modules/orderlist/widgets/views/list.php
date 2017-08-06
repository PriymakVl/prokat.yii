<?php

use \yii\helpers\Url;
//use app\modules\orderlist\models\OrderList;

//$this->registerJsFile('js/order/order_list_print.js',  ['depends' => [JqueryAsset::className()]]);

?>
<div  class="sidebar-menu">
    <h5>Списки заказов</h5>   
    <ul >
        <li>
            <a href="<?=Url::to(['/order-list/form'])?>">Создать список</a>
        </li>
        <? if (\Yii::$app->controller->id == 'order'): ?>
            <li>
                <a href="<?=Url::to(['/order-list/list'])?>">Списки заказов</a>
            </li>
        <? else: ?>
            <li>
                <a href="#" onclick="return false;" id="order-list-delete">Удалить списки</a>
            </li>
            <li>
                <a href="<?=Url::to(['/order/list'])?>">Перечень заказов</a>
            </li>
        <? endif; ?>
    </ul>
</div>