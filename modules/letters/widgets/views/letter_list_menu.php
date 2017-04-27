<?php

use \yii\helpers\Url;
use \yii\web\JqueryAsset;

$this->registerJsFile('js/order/order_list_print.js',  ['depends' => [JqueryAsset::className()]]);
?>
<div  class="sidebar-menu">
    <h5>Список писем</h5>   
    <ul >
        <li>
            <a href="#" onclick="return false;" id="letter-list-print">Распечатать список</a>    
        </li> 
    </ul>
</div>