<?php

use \yii\web\JqueryAsset;
use \yii\helpers\Url;

$this->registerJsFile('js/order/item_form_set_material.js',  ['depends' => [JqueryAsset::className()]]);

?>

<div id="order-content-item-material">
    <label>Выбрать материал:</label>
    <select>
        <option value="" selected="selected">Не выбран</option>
        <option value="Ст45">Ст45</option>
        <option value="Ст40Х">Ст40Х</option>
        <option value="Ст20">Ст20</option>
        <option value="Ст3">Ст3</option>
        <option value="Ст3пс">Ст3пс</option>
        <option value="ОЦС 5-5-5">ОЦС 5-5-5</option>
    </select>
</div>