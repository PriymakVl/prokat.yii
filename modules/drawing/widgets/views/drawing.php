<?php

use \yii\web\JqueryAsset;

$this->registerJsFile('js/list/dwg_delete.js',  ['depends' => [JqueryAsset::className()]]);

?>

<div  class="sidebar-menu">
    <h5>Чертеж</h5> 
    <ul id="dwg-managment-menu">
        <li>
            <a href="<?=Yii::$app->urlManager->createUrl(['drawing/'.$type.'/form'])?>">Добавить чертеж в базу</a>
        </li>
        <? if ($dwg_id): ?>
            <li>
                <a href="<?=Yii::$app->urlManager->createUrl(['drawing/'.$type.'/delete', 'dwg_id' => $dwg_id])?>">Удалить чертеж из базы</a>
            </li>
            <li>
                <a href="<?=Yii::$app->urlManager->createUrl(['drawing/'.$type.'/form', 'dwg_id' => $dwg_id])?>">Редактировать чертеж</a>
            </li>
        <? endif; ?>
    </ul>    
</div>