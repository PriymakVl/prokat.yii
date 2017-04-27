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
    <table id="department-dwg-all">
        <tr>
            <th width="30">
                <input type="checkbox" disabled="disabled" />
            </th>
            <th width="230">№ чертежа</th>
            <th width="460">Наименование</th>
        </tr>
        <? if ($list): ?>
            <? foreach ($list as $dwg): ?>
                <tr>
                    <td>
                        <input type="checkbox" name="drawing" dwg_id="<?=$dwg->id?>" />
                    </td>
                    <td class="text-center">
                        <? if($dwg->type == 'folder'): ?>
                            <?= Html::a('папка №'.$dwg->id, ['/drawing/works/specification/', 'dwg_id' => $dwg->id]) ?>
                        <? elseif(count($dwg->files) > 1): ?>
							<a href="<?=Url::to(['/drawing/works/files', 'dwg_id' => $dwg->id])?>"><?=$dwg->number?></a>
                        <? elseif($dwg->files): ?>
							<a href="<?=Url::to(['/files/works/'.$dwg->files[0]->file])?>" target="_blank"><?=$dwg->number?></a>
                        <? else: ?>
                            <?=$dwg->number?>
                        <? endif; ?>
                    </td>
                    <td>
                        <?= Html::a($dwg->name, ['/drawing/works', 'dwg_id' => $dwg->id]) ?>
                    </td>
                </tr>
            <? endforeach; ?>
        <? else: ?>
            <tr>
                <td colspan="4" class="not-content">Чертежей нет</td>
            </tr>
        <? endif; ?>
    </table>
    
    <!-- type drawing hidden -->
    <input type="hidden" value="<?=Yii::$app->controller->id?>" id="dwg-controller"/>
	
	<!-- pagination -->
    <div class="pagination-wrp">
        <?=LinkPager::widget(['pagination' => $pages])?>    
    </div><!-- class pagination-wrp -->
</div>

<!-- menu -->
<div class="sidebar-wrp">
    <?=MainMenuWidget::widget()?>
    
    <?=DrawingListMenuWidget::widget()?>
    
    <?=DrawingMenuWidget::widget()?>
    
    <?=DrawingMainMenuWidget::widget()?>
</div>