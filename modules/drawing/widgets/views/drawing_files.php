<?php

use \yii\web\JqueryAsset;

?>

<div  class="sidebar-menu">
    <h5>Файлы чертежа</h5> 
    <ul id="dwg-file-managment-menu">
        <li>
            <a href="<?=Yii::$app->urlManager->createUrl(['drawing/'.$type.'/file/form', 'dwg_id' => $dwg_id])?>">Добавить файл</a>
        </li>
        <li>
            <a href="#" onclick="return false;" id="dwg-file-delete">Удалить  файл</a>
        </li>
        <li>
            <a href="#" onclick="return false;" id="dwg-file-update">Редактировать  файл</a>
        </li>
    </ul>    
</div>