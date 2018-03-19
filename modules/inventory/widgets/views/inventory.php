<?php
use \yii\helpers\Url;

?>
<div  class="sidebar-menu">
    <h5>Инв. номер</h5>   
    <ul >
        <li>
            <a href="<?=Url::to(['/inventory/form'])?>">Добавить номер</a>
        </li>
        <li>
            <a href="<?=Url::to(['/inventory/delete', 'inv_id' => $inv->id])?>">Удалить номер</a>
        </li> 
        <li>
            <a href="<?=Url::to(['/inventory/form', 'inv_id' => $inv->id])?>">Редактировать номер</a>
        </li>
        <? if (Yii::$app->controller->action->id != 'list'): ?>
            <li>
                <a href="<?=Url::to(['/inventory/list'])?>">Каталог</a>
            </li>
        <? endif; ?>
    </ul>
</div>