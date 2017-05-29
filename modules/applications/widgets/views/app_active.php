<?php

use \yii\helpers\Url;
use \yii\web\JqueryAsset;

?>
<div  class="sidebar-menu">
    <h5>Активная заявка</h5>   
    <ul >
        <? if ($app_id): ?>
            <li>
                <a href="<?=Url::to(['/application/active/set', 'app_id' => $app_id])?>">Сделать активной</a>
            </li>
        <? endif; ?>
         <li>
            <a href="<?=Url::to(['/application/active/get'])?>">Перейти к активной</a>
        </li>
    </ul>
</div>