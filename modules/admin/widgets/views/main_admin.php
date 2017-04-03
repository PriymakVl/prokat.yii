<?php

use \yii\web\JqueryAsset;

?>

<div  class="sidebar-menu">
    <h5>Админка</h5> 
    <ul>
        <li>
            <a href="<?=Yii::$app->urlManager->createUrl(['drawing/standard/danieli/form'])?>">Доб. файл ст. danieli</a>
            <a href="<?=Yii::$app->urlManager->createUrl(['admin/excel/file/read'])?>">Прочитать excel</a>
        </li>
        
    </ul>    
</div>