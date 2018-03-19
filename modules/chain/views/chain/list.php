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
    <div class="title-box">Перечень цепей стана 400/200</div>
    
    <!-- top menu -->
     <?//=ChainListTopMenuWidget::widget(['params' => $params])?>
     
    <!-- list chains -->
    <table id="department-dwg-all" class="margin-top-15">
        <tr>
            <th width="30">
                <input type="radio" disabled="disabled" />
            </th>
            <th width="110">Код</th>
            <th width="200">Оборудование</th>
            <th width="200">Узел</th>
            <th width="90">ISO</th>
            <th width="90">Гост</th>
        </tr>
        <? if ($list): ?>
            <? foreach ($list as $chain): ?>
                <tr>
                    <td>
                        <input type="radio" name="chain" dwg_id="<?=$chain->id?>" />
                    </td>
                    <td class="text-center">
                        <a href="<?=Url::to(['/chain', 'chain_id'=>$chain->id])?>"><?=$chain->code?></a>
                    </td>
                    </td>
                    <td>
                        <?=$chain->equipment?>
                    </td>
                    <td>
                        <?=$chain->unit?>
                    </td>
                    <td class="text-center">
                        <? if ($chain->iso): ?>
                            <a href="<?=Url::to(['/chain/iso', 'iso_id' => $chain->iso_id])?>"><?=$chain->iso->name?></a>
                        <? else: ?>
                            <span class="red">Нет</span>
                        <? endif; ?>
                    </td>
                    <td class="text-center">
                        <? if ($chain->gost): ?>
                            <a href="<?=Url::to(['/chain/gost', 'gost_id' => $chain->gost_id])?>"><?=$chain->gost->name?></a>
                        <? else: ?>
                            <span class="red">Нет</span>
                        <? endif; ?>
                    </td>
                </tr>
            <? endforeach; ?>
        <? else: ?>
            <tr>
                <td colspan="7" class="not-content">Цепей нет</td>
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