<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\widgets\MainMenuWidget;
use app\modules\drawing\widgets\DrawingMainMenuWidget;
use app\modules\drawing\widgets\DrawingWorksTopMenuWidget;
    
$this->registerCssFile('/css/drawing.css');

?>
<div class="content list-all">
     <!-- parent info -->
    <div class="title-box dwg-folder">
        <? if ($parent->type == 'folder'): ?>
            <span>папка:</span>
        <? else: ?>
            <span>cборочный чертеж:</span>
        <? endif; ?>
        &laquo; <?=$parent->name?> &raquo;
    </div>
    
    <!-- top menu -->
    <?=DrawingWorksTopMenuWidget::widget(['dwg' => $parent])?>
    
    <!-- children list -->
    <table id="department-dwg-folder">
        <tr>
            <th width="30">
                <input type="radio" disabled="disabled" />
            </th>
            <th width="70">Позиция</th> 
            <th width="160">№ чертежа</th>
            <th width="460">Наименование</th>
        </tr>
        <? if ($specification): ?>
            <? foreach ($specification as $dwg): ?>
                <tr>
                    <td>
                        <input type="radio" name="drawing" dwg_id="<?=$dwg->id?>" />
                    </td>
                    <td class="text-center">
                        <?=$dwg->item?>
                    </td> 
                    <td class="text-center">
                        <? if($dwg->type == 'folder'): ?>
                            <?= Html::a('папка №'.$dwg->id, ['/drawing/works/specification/', 'dwg_id' => $dwg->id]) ?>
                        <? elseif(count($dwg->files) > 1): ?>
                            <?= Html::a($dwg->number, ['/drawing/works/files', 'dwg_id' => $dwg->id]) ?>
                        <? elseif($dwg->files): ?>
                            <?= Html::a($dwg->number, ['/files/works/'.$dwg->files[0]->file]) ?>
                        <? else: ?>
                            <?=$dwg->number?>
                        <? endif; ?>
                    </td>
                    <td>
                        <?= Html::a($dwg->name, ['/drawing/works/', 'dwg_id' => $dwg->id]) ?>
                    </td>
                </tr>
            <? endforeach; ?>
        <? else: ?>
            <tr>
                <td colspan="4" class="not-content">Чертежей нет</td>
            </tr>
        <? endif; ?>
    </table>
</div>

<!-- menu -->
<div class="sidebar-wrp">
    <?=MainMenuWidget::widget()?>
    <?=DrawingMainMenuWidget::widget()?>
</div>