<?php

use \yii\web\JqueryAsset;

$this->registerJsFile('js/list/list_delete.js',  ['depends' => [JqueryAsset::className()]]);
$this->registerJsFile('js/list/list_active.js',  ['depends' => [JqueryAsset::className()]]);

?>

<div  class="sidebar-menu">
    <h5>Список</h5> 
    <!-- list menu -->   
    <ul id="all-list-menu">
        <? if ($action == 'all'): ?>
            <li>
                <a href="#" onclick="return false;" id="list-active">Сделать активным</a>
            </li>
        <? endif; ?>
        <li>
            <a href="<?=Yii::$app->urlManager->createUrl(['/list/form'])?>">Создать список</a>
        </li>
        <? if ($action == 'index'): ?>
            <li>
                <a href="<?=Yii::$app->urlManager->createUrl(['list/form', 'list_id' => $list_id])?>">Редактировать список</a>
            </li>
            <li>
                <a href="#" onclick="return false;" id="list-delete">Удалить список</a>
            </li>  
        <? endif; ?>
        <li>
            <a href="<?=Yii::$app->urlManager->createUrl(['lists'])?>">Все списки</a>
        </li>
        <li>
            <a href="<?=Yii::$app->urlManager->createUrl(['lists/update'])?>">Обновить все списки</a>
        </li>    
    </ul>
</div>

  