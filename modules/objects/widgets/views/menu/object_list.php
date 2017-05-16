<?php

use \yii\web\JqueryAsset;
use yii\helpers\Url;  

$this->registerJsFile('js/object/object_list_copy.js', ['depends' => JqueryAsset::className()]);
$this->registerJsFile('js/object/object_list_delete.js', ['depends' => JqueryAsset::className()]);
$this->registerJsFile('js/object/object_list_checked_all.js', ['depends' => JqueryAsset::className()]);
$this->registerJsFile('js/object/object_list_change_parent.js', ['depends' => JqueryAsset::className()]);
$this->registerJsFile('js/object/object_list_add_order.js', ['depends' => JqueryAsset::className()]);
$this->registerJsFile('js/object/object_list_highlight.js', ['depends' => JqueryAsset::className()]);
?>

<!-- data menu -->
<div  class="sidebar-menu">
    <h5>Список объектов</h5>   
    <ul>
        <li>
            <a href="#" onclick="return false;" id="obj-list-copy">Скопировать объекты</a>
        </li>
        <li>
            <a href="#" onclick="return false;" id="obj-list-add-order">Добавить в заказ</a>
        </li>
        <li>
            <a href="<?=Url::to(['/object/specification/danieli/file/form', 'obj_id' => $obj_id])?>">Добавить из файла</a>
        </li>
        <li>
            <a href="#" onclick="return false;" id="obj-list-delete">Удалить объекты</a>
        </li>
        <li>
            <a href="#" onclick="return false;" id="obj-list-change-parent">Изменить род. объект</a>
        </li>
		<li>
            <a href="#" onclick="return false;" id="obj-list-highlight">Выделить позиции</a>
        </li>
    </ul>   
</div>