<?php

use \yii\web\JqueryAsset;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use app\widgets\MainMenuWidget;
use app\modules\drawing\widgets\DrawingMainMenuWidget;
use app\modules\drawing\widgets\DrawingListMenuWidget;
use app\modules\drawing\widgets\DrawingMenuWidget;
use app\modules\drawing\widgets\DrawingListTopMenuWidget;

$this->registerCssFile('/css/drawing.css');
?>
<div class="content list-all">
    <!-- title -->
    <div class="title-box">Перечень чертежей ПКО комбината</div>
    
    <!-- top menu -->
     <?=DrawingListTopMenuWidget::widget(['params' => $params])?>
     
    <!-- list dwg -->
    <table id="dwg-works-all" class="margin-top-15">
        <tr>
            <th width="30">
                <input type="radio" disabled="disabled" />
            </th>
            <th width="100">№ чертежа</th>
            <th width="300">Наименование</th>
            <th width="100">Код</th>
            <th width="185">Примечание</th>
        </tr>
        <? if ($list): ?>
            <? foreach ($list as $dwg): ?>
                <tr>
                    <td>
                        <input type="radio" name="drawing" dwg_id="<?=$dwg->id?>" />
                    </td>
                    <td class="text-center">
                        <? if ($dwg->sheet_2 || $dwg->sheet_3): ?>
							<a href="<?=Url::to(['/drawing/works', 'dwg_id' => $dwg->id])?>"><?=$dwg->number?></a>
                        <? elseif ($dwg->sheet_1): ?>
                            <a href="<?=Url::to(['/files/works/'.$dwg->sheet_1])?>" target="_blank"><?=$dwg->number?></a>
                        <? else: ?>
                            <?=$dwg->number?>
                        <? endif; ?>
                    </td>
                    <td>
                        <a href="<?=Url::to(['/drawing/works', 'dwg_id' => $dwg->id])?>"><?=$dwg->name?></a>
                    </td>
                    <td class="text-center">
                        <? if ($dwg->code): ?>
                            <a href="<?=Url::to(['/search/object/code', 'code' => $dwg->code])?>"><?=$dwg->code?></a>
                        <? else: ?>
                            <span>Не указан</span>
                        <? endif; ?>
                    </td>
                    <td>
                        <?=$dwg->note?>
                    </td>
                </tr>
            <? endforeach; ?>
        <? else: ?>
            <tr>
                <td colspan="4" class="not-content">Чертежей нет</td>
            </tr>
        <? endif; ?>
    </table>
	
	<!-- pagination -->
    <div class="pagination-wrp">
        <?=LinkPager::widget(['pagination' => $pages])?>    
    </div><!-- class pagination-wrp -->
</div>

<!-- menu -->
<div class="sidebar-wrp">
    <?=MainMenuWidget::widget()?>
    
    <?=DrawingListMenuWidget::widget()?>
    
    <?//=DrawingMenuWidget::widget()?>
    
    <?//=DrawingMainMenuWidget::widget()?>
</div>