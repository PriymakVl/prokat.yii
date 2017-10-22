<?php

use \yii\helpers\Url;

$this->registerJsFile('/js/orderact/act_edit_state.js');
$this->registerJsFile('/js/orderact/act_list_delete.js');

?>
<div  class="sidebar-menu">
    <h5>Перечень актов</h5>   
    <ul >
        <? if (\Yii::$app->controller->id == 'order'): ?>
             <li>
                <a href="<?=Url::to(['/order/act/list'])?>">Акты</a>
            </li>
        <? endif; ?>
        <li>
            <a href="<?=Url::to(['/order/act/form'])?>">Зарегистрировать акт</a>
        </li>
        <li>
            <a href="#" onclick="return false;" id="order-acts-delete">Удалить акты</a>
        </li>
        <li>
            <a href="#" onclick="return false;" id="order-act-passed">Переданы в ЦРМО</a>    
        </li>
        <li>
            <a href="#" onclick="return false;" id="order-act-print">Распечатать перечень</a>    
        </li> 
    </ul>
</div>