<?php

use \yii\helpers\Url;
use \yii\web\JqueryAsset;

?>
<div  class="sidebar-menu">
    <h5>Стандарты</h5>   
    <ul >
        <li>
            <a href="<?=Url::to(['standard/form', 'std_id' => $std_id])?>">Добавить стандарт</a>
        </li>
        <li>
            <a href="#" onclick="return false;" id="dwg-list-update-parent">Добавить в папку</a>
        </li>
    </ul>
</div>