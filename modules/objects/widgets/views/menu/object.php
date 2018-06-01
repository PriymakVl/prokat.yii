<?php

use yii\helpers\Url;

$this->registerJsFile('/js/object/object_delete.js');
$this->registerJsFile('/js/object/object_update.js');
    
?>

<!-- data menu -->
<div  class="sidebar-menu">
    <h5>Объект</h5>   
    <ul>
        <li>
            <a href="<?=Url::to(['/object/form', 'parent_id' => $obj->id])?>">Создать объект</a>
        </li>
        <li>
            <a href="<?=Url::to(['/object/form', 'obj_id' => $obj->id])?>">Редактировать объект</a>
        </li>
        <li>
            <a href="#" onclick="return false;" id="obj-copy">Копировать объект</a>
        </li>
        <li>
            <a href="<?=Url::to(['/object/delete/one', 'obj_id' => $obj->id])?>">Удалить объект</a>
        </li>
        <li>
            <a href="<?=Url::to(['/search/object/code', 'code' => $obj->code])?>">Показать все</a>
        </li>
        <li>
            <a target="_blank" href="<?=Url::to(['/order/content/item/add', 'obj_id' => $obj->id])?>">Добавить в заказ</a>
        </li>
        <li>
            <a href="<?=Url::to(['/list/item/add', 'obj_id' => $obj->id])?>">Добавить в список</a>
        </li>
    </ul>   
</div>