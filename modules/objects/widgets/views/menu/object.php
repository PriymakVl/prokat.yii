<?php

use yii\web\JqueryAsset;
use yii\helpers\Url;

$this->registerJsFile('js/object/object_delete.js',  ['depends' => [JqueryAsset::className()]]);
$this->registerJsFile('js/object/object_update.js',  ['depends' => [JqueryAsset::className()]]);
    
?>

<!-- data menu -->
<div  class="sidebar-menu">
    <h5>Объект</h5>   
    <ul>
        <li>
            <a href="<?=Yii::$app->urlManager->createUrl(['object/form'])?>">Создать объект</a>
        </li>
        <li>
            <a href="<?=Yii::$app->urlManager->createUrl(['object/form', 'obj_id' => $obj_id])?>">Редактировать объект</a>
        </li>
        <li>
            <a href="#" onclick="return false;" id="obj-copy">Копировать объект</a>
        </li>
        <li>
            <a href="<?=Url::to(['/object/delete/one', 'obj_id' => $obj_id])?>">Удалить объект</a>
        </li>
        <li>
            <a target="_blank" href="<?=Url::to(['/order/content/item/add', 'obj_id' => $obj_id])?>">Добавить в заказ</a>
        </li>
    </ul>   
</div>