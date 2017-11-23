<?php

use \yii\helpers\Url;

$this->registerJsFile('/js/object/object_select_material.js');

?>

<div class="object-material-wrp">
    <label>Выбрать материал:</label>
    <select class="form-control object-material">
        <option value="" selected="selected">Не выбран</option>
        <option value="Ст45">Ст45</option>
        <option value="Ст40Х">Ст40Х</option>
    </select>
</div>