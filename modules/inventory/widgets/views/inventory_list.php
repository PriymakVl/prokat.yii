<?php

use \yii\helpers\Url;
//use app\modules\order\models\Order;

$this->registerJsFile('/js/inventory/inventory_delete.js');
$this->registerJsFile('/js/inventory/inventory_edit.js');

?>
<div  class="sidebar-menu">
    <h5>Инв. номера</h5>   
    <ul >
        <li>
            <a href="<?=Url::to(['/inventory/form'])?>">Добавить номер</a>
        </li>
        <li>
            <a href="#" onclick="return false;" id="inventory-delete">Удалить номер</a>
        </li> 
        <li>
            <a href="#" onclick="return false;" id="inventory-edit">Редактировать номер</a>
        </li>
        <!--
        <li>
            <a href="#" onclick="return false;" id="inventory-list-print">Распечатать перечень</a>    
        </li>
        --> 
    </ul>
</div>