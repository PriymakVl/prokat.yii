<?php

use \yii\helpers\Url;

//$this->registerJsFile('js/order/order_list_print.js',  ['depends' => [JqueryAsset::className()]]);

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
            <a href="#" onclick="return false;" id="order-act-print">Распечатать перечень</a>    
        </li> 
    </ul>
</div>