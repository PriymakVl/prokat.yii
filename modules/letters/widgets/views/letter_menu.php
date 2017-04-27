<?php

use \yii\helpers\Url;
use \yii\web\JqueryAsset;

?>
<div  class="sidebar-menu">
    <h5>Письмо</h5>   
    <ul >
        <li>
            <a href="<?=Url::to(['/letter/form'])?>">Написать письмо</a>
        </li>
        <? if ($letter_id): ?>
            <li>
                <a href="<?=Url::to(['/letter/form', 'letter_id' => $letter_id])?>">Редактировать письмо</a>
            </li>
             <li>
                <a href="<?=Url::to(['/letter/delete', 'letter_id' => $letter_id])?>">Удалить письмо</a>
            </li>
            <li>
                <a href="<?=Url::to(['/letter/print', 'letter_id' => $letter_id])?>">Напечатать письмо</a>
            </li>
            <li>
                <a href="<?=Url::to(['/letter/save/pdf', 'letter_id' => $letter_id])?>">Сохранить как PDF</a>
            </li>
            <li>
                <a href="<?=Url::to(['/letter/save/pdf', 'letter_id' => $letter_id])?>">Сохранить как WORD</a>
            </li>
        <? endif; ?>
    </ul>
</div>