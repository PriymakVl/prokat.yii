<?php

use yii\helpers\Url;
//use yii\widgets\LinkPager;
use app\widgets\MainMenuWidget;
use app\modules\chain\widgets\ChainMenuWidget;
//use app\modules\drawing\widgets\DrawingMenuWidget;

$this->registerCssFile('/css/chain.css');

?>
<div class="content list-all">
    <!-- title -->
    <div class="title-box">Цепи (ISO 606-94, DIN 8187-1)</div>
    
    <!-- top menu -->
     <?//=ChainListTopMenuWidget::widget(['params' => $params])?>
     
    <!-- list chains iso-->
    <table class="margin-top-15">
        <tr>
            <th width="30">
                <input type="radio" disabled="disabled" />
            </th>
            <th width="150">Тип цепи</th>
            <th width="90">Серия</th>
            <th width="200">Обозначение цепи</th>
            <th width="100">Шаг</th>
            <th width="150">Аналог</th>
        </tr>
        <? if ($iso): ?>
            <? foreach ($iso as $chain): ?>
                <tr>
                    <td>
                        <input type="radio" name="chain" chain_id="<?=$chain->id?>" />
                    </td>
                    <td class="text-center">
                        <?=$chain->type?>
                    </td>
                    </td>
                    <td class="text-center">
                        <?=$chain->series?>
                    </td>
                    <td class="text-center">
                        <a href="<?=Url::to(['/chain/iso', 'iso_id' => $iso->id])?>"><?=$chain->name?></a>
                    </td>
                    <td class="text-center">
                        <?=$chain->step?>
                    </td>
                    <td class="text-center">
                        <a href="#">аналог</a>
                    </td>
                </tr>
            <? endforeach; ?>
        <? else: ?>
            <tr>
                <td colspan="6" class="not-content">Цепей нет</td>
            </tr>
        <? endif; ?>
    </table>
</div>

<!-- menu -->
<div class="sidebar-wrp">
    <?=MainMenuWidget::widget()?>
    <?=ChainMenuWidget::widget()?>
    <?//=DrawingMainMenuWidget::widget()?>
</div>