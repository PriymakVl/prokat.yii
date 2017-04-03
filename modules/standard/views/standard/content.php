<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\components\other\MainMenuWidget;
use app\modules\standard\components\StandardMenuWidget;
    
$this->registerCssFile('/css/standard.css');

?>
<div class="content list-all">
    <!-- title -->
    <div class="title-box dwg-folder"><span>папка:</span><?=$parent->name?></div>
    
    <!-- content -->
    <table id="standart-list">
        <tr>
            <th width="30">
                <input type="checkbox" disabled="disabled" />
            </th>
            <th width="110">Обозначение</th>
            <th width="130">№ стандарта</th>
            <th width="450">Наименование</th>
        </tr>
        <? if ($children): ?>
            <? foreach ($children as $std): ?>
                <tr>
                    <td>
                        <input type="checkbox" name="drawing" std_id="<?=$std->id?>" />
                    </td>
                    <td class="text-center">
                       <?=$std->category ? $std->category : "Не указано"?>
                    </td>
                    <td class="text-center">
                        <? if(count($std->files) == 1): ?>
                            <?= Html::a($std->number, ['/standard/other/'.$std->file], ['target' => '_blank']) ?>
                        <? elseif($dwg->files): ?>
                            <?= Html::a('папка', ['/standard/files/', 'std_id' => $std->id]) ?>
                        <? else: ?>
                            <?=$std->number ? $std->number : 'Не указан'?>
                        <? endif; ?>
                    </td>
                    <td>
                        <? if($std->type == 'folder'): ?>
                            <?= Html::a($std->name, ['/standard/content/', 'std_id' => $std->id]) ?>
                        <? else: ?>
                            <?= Html::a($std->name, ['/standard/', 'std_id' => $std->id]) ?>
                        <? endif; ?>
                    </td>
                    
                </tr>
            <? endforeach; ?>
        <? else: ?>
            <tr>
                <td colspan="4" class="not-content">Стандартов нет</td>
            </tr>
        <? endif; ?>
    </table>
</div><!-- class content -->

<!-- menu -->
<div class="sidebar-wrp">
    <?=MainMenuWidget::widget()?>
</div>