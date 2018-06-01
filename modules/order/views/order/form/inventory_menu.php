<?php

use \yii\helpers\Url;

$this->registerJsFile('/js/order/order_form/form_add_inventory.js');

?>
<!-- inventory menu -->
<div class="top-menu top-menu-margin" id="inventory-menu" style="display:none;">
    <label>Категории: </label>
    <select id="inventory-sort">
        <option value="all">Все</option>
        <option value="mill">Стан</option>
        <option value="stand">Клети</option>
        <option value="sort">Сортовая</option>
        <option value="bunt">Бунтовая</option>
        <option value="gydro">Гидравлика</option>
        <option value="grease">Смазка</option>
        <option value="finish">Отделка</option>
        <option value="crane">Краны</option>
        <option value="talie">Тали</option>
        <option value="sundbirsta">Sundbirsta</option>
        <option value="loop">Петлеобразователи</option>
        <option value="cart">Тележки</option>
        <option value="stock">Склад заготовок</option>
        <option value="">Без категории</option>
        <option value="pinch-roll">Трайб-аппараты</option>
        <option value="shear">Ножницы</option>
        <option value="sliting">Слитинг</option>
        <option value="building">Здания</option>
    </select>
</div>