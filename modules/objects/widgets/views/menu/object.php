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
            <a href="<?=Url::to(['/object/form', 'parent_id' => $obj_id])?>">Создать объект</a>
        </li>
        <li>
            <a href="<?=Url::to(['/object/form', 'obj_id' => $obj_id])?>">Редактировать объект</a>
        </li>
        <li>
            <a href="#" onclick="return false;" id="obj-copy">Копировать объект</a>
        </li>
        <li>
            <a href="<?=Url::to(['/object/delete/one', 'obj_id' => $obj_id])?>">Удалить объект</a>
        </li>
        <li>
            <a href="<?=Url::to(['/product/list', 'obj_id' => $obj_id])?>">Показать все</a>
        </li>
        <li>
            <a target="_blank" href="<?=Url::to(['/order/content/item/add', 'obj_id' => $obj_id])?>">Добавить в заказ</a>
        </li>
    </ul>   
</div>