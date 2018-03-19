<?php

use \yii\helpers\Url;

$this->registerJsFile('/js/inventory/sort_category.js');

?>
<!-- inventory menu -->
<div class="top-menu top-menu-margin">
    <label>Категория:</label>
    <select id="inventory-sort">
        <option value="all">Все</option>
        <option value="mill" <? if ($params['category'] == 'mill') echo 'selected'; ?>>Стан</option>
        <option value="stand" <? if ($params['category'] == 'stand') echo 'selected'; ?>>Клети</option>
        <option value="sort" <? if ($params['category'] == 'sort') echo 'selected'; ?>>Сортовая</option>
        <option value="bunt" <? if ($params['category'] == 'bunt') echo 'selected'; ?>>Бунтовая</option>
        <option value="gydro" <? if ($params['category'] == 'gydro') echo 'selected'; ?>>Гидравлика</option>
        <option value="grease" <? if ($params['category'] == 'grease') echo 'selected'; ?>>Смазка</option>
        <option value="finish" <? if ($params['category'] == 'finish') echo 'selected'; ?>>Отделка</option>
        <option value="crane" <? if ($params['category'] == 'crane') echo 'selected'; ?>>Краны</option>
        <option value="talie" <? if ($params['category'] == 'talie') echo 'selected'; ?>>Тали</option>
        <option value="sundbirsta" <? if ($params['category'] == 'sundbirsta') echo 'selected'; ?>>Sundbirsta</option>
        <option value="loop" <? if ($params['category'] == 'loop') echo 'selected'; ?>>Петлеобразователи</option>
        <option value="cart" <? if ($params['category'] == 'cart') echo 'selected'; ?>>Тележки</option>
        <option value="stock" <? if ($params['category'] == 'stock') echo 'selected'; ?>>Склад заготовок</option>
        <option value="without" <? if ($params['category'] == 'without') echo 'selected'; ?>>Без категории</option>
        <option value="pinch-roll" <? if ($params['category'] == 'pinch-roll') echo 'selected'; ?>>Трайб-аппараты</option>
        <option value="shear" <? if ($params['category'] == 'shear') echo 'selected'; ?>>Ножницы</option>
        <option value="sliting" <? if ($params['category'] == 'sliting') echo 'selected'; ?>>Слитинг</option>
        <option value="building" <? if ($params['category'] == 'building') echo 'selected'; ?>>Здания</option>
    </select>
</div>