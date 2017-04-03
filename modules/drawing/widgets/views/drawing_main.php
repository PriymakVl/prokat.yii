<?php

use \yii\web\JqueryAsset;

?>

<div  class="sidebar-menu" id="dwg-all-menu">
    <h5>Чертежи</h5>   
    <ul >
        <li>
            <a href="<?=Yii::$app->urlManager->createUrl(['drawing/vendor/danieli'])?>">Чертежи Danieli</a>
        </li>
        <li>
            <a <? if ($controller == 'drawingdepartment') echo 'class="active-link"'; ?> href="<?=Yii::$app->urlManager->createUrl(['drawing/department/list'])?>">Чертежи цеха</a>
        </li>
        <li>
            <a <? if ($controller == 'drawingworks') echo 'class="active-link"'; ?> href="<?=Yii::$app->urlManager->createUrl(['drawing/works/list'])?>">Чертежи ПКО</a>
        </li>      
        <li>
            <a href="<?=Yii::$app->urlManager->createUrl(['drawing/other/list'])?>">Разное</a>
        </li>
    </ul>
</div>