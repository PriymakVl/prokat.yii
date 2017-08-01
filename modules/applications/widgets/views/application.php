<?php

use \yii\helpers\Url;
use \yii\web\JqueryAsset;

?>
<div  class="sidebar-menu">
    <h5>Заявка</h5>   
    <ul >
        <li>
            <a href="<?=Url::to(['/application/form'])?>">Выдать заявку</a>
        </li>
        <li>
            <a href="<?=Url::to(['/application/form', 'app_id' => $app_id])?>">Редактировать заявку</a>
        </li>
         <li>
            <a href="<?=Url::to(['/application/delete', 'app_id' => $app_id])?>">Удалить заявку</a>
        </li>
        <li>
            <a href="<?=Url::to(['/application/print', 'app_id' => $app_id])?>">Создать файл заявки</a>
        </li>
        <li>
            <a href="<?=Url::to(['/application/content/sheet/print', 'app_id' => $app_id])?>">Создать расчет обосн</a>
        </li>
    </ul>
</div>