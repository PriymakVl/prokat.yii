<?php

use \yii\helpers\Url;

$this->registerJsFile('/js/orderact/item_act_delete.js');
$this->registerJsFile('/js/orderact/item_act_edit.js');
?>

<div  class="sidebar-menu">
    <h5>Элементы акта</h5>   
    <ul >
        <li>
            <a href="<?=Url::to(['/order/act/content/form', 'act_id' => $act->id])?>">Добавить элемент</a>
        </li>
        <li>
            <a href="#" onclick="return false;" id="edit-act-item">Редактировать элемент</a>
        </li>
         <li>
            <a href="#" onclick="return false;" id="delete-act-item">Удалить элемент</a>
        </li>
    </ul>
</div>