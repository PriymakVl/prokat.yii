<?php

use \yii\helpers\Url;

//$this->registerJsFile('js/order/order_copy.js');
?>

<div  class="sidebar-menu">
    <h5>Акт</h5>   
    <ul >
        <li>
            <a href="<?=Url::to(['/order/act/form'])?>">Зарегистрировать акт</a>
        </li>
        <li>
            <a href="<?=Url::to(['/order/act/form', 'act_id' => $act->id])?>">Редактировать акт</a>
        </li>
         <li>
            <a href="<?=Url::to(['/order/act/delete', 'act_id' => $act->id])?>">Удалить акт</a>
        </li>
        <li>
            <a href="<?=Url::to(['/order/act/demand/print', 'act_id' => $act->id])?>">Создать требование</a>
        </li>
    </ul>
</div>