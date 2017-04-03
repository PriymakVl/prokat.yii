<?php

    use \yii\web\JqueryAsset;
    
    $this->registerJsFile('js/list/list_item_delete.js',  ['depends' => [JqueryAsset::className()]]);
    $this->registerJsFile('js/list/list_item_update.js',  ['depends' => [JqueryAsset::className()]]);
    $this->registerJsFile('js/list/list_item_show.js',  ['depends' => [JqueryAsset::className()]]);
    
?>
<div  class="sidebar-menu">
    <h5>Элементы списка</h5> 
    <ul id="list-content-menu">
        <? if ($obj_id): ?>
            <li>
                <a href="<?=Yii::$app->urlManager->createUrl(['list/item/add', 'obj_id' => $obj_id])?>">Добавить в список</a>
            </li>
        <? else: ?>
            <li>
                <a href="#" onclick="return false;" id="list-item-update">Редактировать элемент</a>
            </li>
            <li>
                <a href="#" onclick="return false;" id="list-item-delete">Удалить из списка</a>
            </li>
        <? endif; ?>
    </ul>    
</div>