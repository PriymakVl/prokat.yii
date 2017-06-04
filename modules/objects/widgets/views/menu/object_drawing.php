<?php
    use \yii\web\JqueryAsset;
    
    $this->registerJsFile('js/drawing/dwg_add_order.js', ['depends' => JqueryAsset::className()]);
    $this->registerJsFile('js/drawing/dwg_add_object.js',  ['depends' => [JqueryAsset::className()]]);
    $this->registerJsFile('js/drawing/dwg_delete_object.js',  ['depends' => [JqueryAsset::className()]]);
    $this->registerJsFile('js/drawing/dwg_note_object.js',  ['depends' => [JqueryAsset::className()]]);
    $this->registerJsFile('/js/drawing/dwg_venodor_obj_update.js', ['depends' => JqueryAsset::className()]);
?>

<div  class="sidebar-menu" id="dwg-list-menu">
    <h5>Чертежи объекта</h5> 
    <ul id="dwg-managment-menu">
            <li>
                <a href="<?=Yii::$app->urlManager->createUrl(['object/drawing/form', 'obj_id' => $obj_id])?>">Добавить чертеж</a>
            </li>
            <li>
                <a href="#" onclick="return false;" id="dwg-delete-obj">Удалить чертеж</a>
            </li>
            <li>
                <a href="#" onclick="return false;" id="dwg-vendor-update">Редакт черт. производ</a>
            </li>
            <li>
                <a href="#" onclick="return false;" id="dwg-add-order-item">Добавить в заказ</a>
            </li>
            <li>
                <a href="#" onclick="return false;" id="dwg-add-note">Добавить примечание</a>
            </li>
<!--
            <li>
               <a href="#">Добавить в базу</a>
            </li>
            <li>
                <a href="#" onclick="return false;" id="dwg-delete">Удалить из базы</a>
            </li>
-->
    </ul>    
</div>