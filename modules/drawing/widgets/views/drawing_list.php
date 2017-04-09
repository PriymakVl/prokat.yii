<?php

use yii\web\JqueryAsset;

$this->registerJsFile('js/drawing/list_update_parent.js',  ['depends' => [JqueryAsset::className()]]);
?>
<div  class="sidebar-menu" id="dwg-list-menu">
    <h5>Список чертежей</h5>   
    <ul >
        <li>
            <a href="#" onclick="return false;" id="dwg-list-update-parent">Изменить род. элемент</a>
        </li>
    </ul>
    <!--for js file list_update_parent-->
    <input type="hidden" value="<?=$category?>" id="dwg-category"/>
</div>