<?php

use yii\helpers\Url;
use yii\web\JqueryAsset;
use app\modules\applications\models\Application;

//$this->registerJsFile('js/order/order_list_print.js',  ['depends' => [JqueryAsset::className()]]);
?>
<div  class="sidebar-menu">
    <h5>Список заявок</h5>   
    <ul >
        <li>
            <a href="<?=Url::to(['/application/form'])?>">Выдать заявку</a>
        </li>
        <? if ($state): ?>
            <li>
                <? if ($state == Application::STATE_APP_ACTIVE): ?>
                    <a href="<?=Url::to(['/order/list'])?>">Заявки</a>
                <? elseif ($state == Application::STATE_APP_DRAFT): ?>
                    <a href="<?=Url::to(['/application/list', 'state' => Application::STATE_APP_DRAFT])?>">Черновики</a>
                <? endif; ?>
            </li> 
        <? endif; ?>
        <li>
            <a href="#" onclick="return false;" id="app-list-print">Распечатать список</a>    
        </li> 
    </ul>
</div>