<?php

use \yii\helpers\Url;
use \yii\web\JqueryAsset;

?>
<div  class="sidebar-menu">
    <h5>Список заказов</h5>   
    <ul >
        <li>
            <a href="<?=Url::to(['/order/form'])?>">Выдать заказ</a>
        </li>
        <li>
            <? if ($action == 'list'): ?>
                <a href="<?=Url::to(['/order/drafts/list'])?>">Черновики</a>
            <? elseif ($action == 'drafts-list'): ?>
                <a href="<?=Url::to(['/order/list'])?>">Заказы</a>
            <? endif; ?>
        </li> 
        <li>
            <a href="<?=Url::to(['/order/list/file/save'])?>">Сохранить в файл</a>    
        </li> 
    </ul>
</div>