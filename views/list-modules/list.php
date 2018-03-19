<?php

use yii\helpers\Url;
use app\widgets\MainMenuWidget;
use app\widgets\FlashMessageWidget;

//$this->registerCssFile('/css/standard.css');

?>
<div class="content">
    <!-- title -->
    <div class="title-box">Перечень модулей</div>

    <!-- flash messge -->
    <?=FlashMessageWidget::widget()?>
    
    <!-- list modules -->
    <table class="margin-top-15">
        <tr>
            <th width="60">№</th>
            <th width="350">Наименование</th>
            <th width="310">Примечание</th>
        </tr>
        <tr>
            <td class="text-center">1</td>
            <td>
                <a href="<?=Url::to(['/inventory/list'])?>">Инвентарные номера</a>
            </td>
            <td></td>
        </tr>
        <tr>
            <td class="text-center">2</td>
            <td>
                <a href="<?=Url::to(['/chain/list'])?>">Цепи</a>
            </td>
            <td></td>
        </tr>
    </table>
</div><!-- class content -->

<!-- menu -->
<div class="sidebar-wrp">
    <?=MainMenuWidget::widget()?>
</div>