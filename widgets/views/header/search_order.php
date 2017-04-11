<?php
use yii\web\JqueryAsset;

$this->registerJsFile('js/order/change_search_order.js', ['depends' => JqueryAsset::className()]); 
?>
<div class="header search-box search-order">
    <a href="/" class="link-home">Главная</a>
     <label>Заказ</label>
    <input type="radio" name="search" value="order_num" checked="checked" holder="Введите номер заказа"/>
    <label>Чертеж</label>
    <input type="radio" name="search" value="dwg_num" holder="Введите номер чертежа"/>
    
    <form action="/search/order" class="search-header" method="get">
        <input type="text" name="order_num" placeholder="Введите номер заказа" autofocus />
        <input type="submit" value="Найти" />
    </form>
</div> 