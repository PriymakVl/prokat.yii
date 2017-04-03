<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\components\other\MainMenuWidget;
use app\modules\standard\components\StandardMenuWidget;
use app\modules\standard\components\StandardTopMenuWidget;

$this->registerCssFile('/css/standard.css');

?>
<div class="content">
    <!-- top nenu -->
    <?=StandardTopMenuWidget::widget(['std_id' => $std->id])?>
    
    <!-- standard data -->
    <table id="std-data">
        <tr>
            <th width="200">Наименование</th>
            <th width="525">Значение</th>
        </tr>
        
        <!-- name -->
        <tr>
            <td class="text-center">
                <? if ($std->type == 'folder'): ?>
                    Название папки
                <? else: ?>
                    Назание стандарта
                <? endif; ?>
            </td>
            <td>
                <? if ($std->child): ?>
                    <?= Html::a($std->name, ['/standard/content', 'std_id' => $std->id]) ?>
                <? else: ?>
                    <?=$std->name?>
                <? endif; ?>
            </td>
        </tr>
        
        <!-- number -->
        <tr>
            <td class="text-center">
                <?=($std->type == 'folder') ? 'Номер папки' : 'Номер стандарта' ?>

            </td>
            <td>
                <? if ($std->type == 'folder'): ?>
                    <?=$std->id?>
                <? elseif ($std->number): ?>
                    <?=$std->number?>
                <? else: ?>
                    'Не указано'
                <? endif; ?>
            </td>
        </tr>
        
        <!-- note -->
        <? if ($std->note): ?>
            <tr>
                <td class="text-center">Примечание</td>
                <td><?=$std->note?></td>
            </tr>
        <? endif; ?>

    </table>
</div>
<!-- menu -->
<div class="sidebar-wrp">
    <?=MainMenuWidget::widget()?>
    
    <?=StandardMenuWidget::widget()?>
</div>