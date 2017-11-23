<?php

use \yii\helpers\Url;

$this->registerJsFile('/js/object/object_select_analog.js');

?>

<div class="object-analog-wrp">
    <label>Выбрать аналог:</label>
    <select class="form-control object-analog">
        <option value="" selected="selected">Не выбран</option>
        <option value="Ст45">Ст45</option>
        <option value="Ст40Х">Ст40Х</option>
        <option value="Ст50Г">Ст50Г</option>
        <option value="Ст65Г">Ст65Г</option>
        <option value="Ст20">Ст20</option>
        <option value="Ст3">Ст3</option>
        <option value="ОЦС 5-5-5">Бр ОЦС 5-5-5</option>
        <option value="Cб">Узел</option>
    </select>
</div>