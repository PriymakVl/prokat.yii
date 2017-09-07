<?php
    use yii\helpers\Url;
    
    $this->registerJsFile('/js/drawing/dwg_add_order.js');
    $this->registerJsFile('/js/drawing/dwg_delete_object.js');
    //$this->registerJsFile('/js/drawing/dwg_note_object.js');
    $this->registerJsFile('/js/drawing/dwg_obj_update.js');
?>

<div  class="sidebar-menu" id="dwg-list-menu">
    <h5>Чертежи объекта</h5> 
    <ul id="dwg-managment-menu">
            <li>
                <a href="<?=Url::to(['/object/drawing/form', 'obj_id' => $obj_id])?>">Добавить чертеж</a>
            </li>
            <li>
                <a href="#" onclick="return false;" id="dwg-delete-obj">Удалить чертеж</a>
            </li>
            <li>
                <a href="#" onclick="return false;" id="dwg-update">Редактировать чертеж</a>
            </li>
            <!--
            <li>
                <a href="#" onclick="return false;" id="obj-dwg-add-order">Добавить в заказ</a>
            </li>-->
    </ul>    
</div>