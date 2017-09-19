<?php

use yii\helpers\Url;
use app\widgets\MainMenuWidget;
use app\modules\drawing\widgets\DrawingMenuWidget;
use app\modules\drawing\widgets\DrawingMainMenuWidget;
use app\modules\drawing\widgets\DrawingWorksTopMenuWidget;

$this->registerCssFile('/css/drawing.css');

?>
<div class="content">
    <!-- top nenu -->
    <?=DrawingWorksTopMenuWidget::widget(['dwg' => $dwg])?>
    
    <!-- data orawing -->
    <table class="dwg-data">
        <tr>
            <th width="160">Наименование</th>
            <th width="560">Значение</th>
        </tr>
        
        <!-- name -->
        <tr>
            <td>Название</td>
            <td>
                <?=$dwg->name?>           
            </td>
        </tr>
        
        <!-- number -->
        <tr>    
            <td>Номер</td>
            <td>
                <?=$dwg->number?>
            </td>
        </tr>
        
        <!-- sheet 1 -->
        <tr>
            <td>Лист 1</td>
            <td>
                <? if ($dwg->sheet_1): ?>
                    <a href="<?=Url::to(['/files/works/'.$dwg->sheet_1])?>"><?=$dwg->sheet_1?></a>
                <? else: ?>
                <span>Нет файла</span>
                <? endif; ?>
            </td>
        </tr>
        
        <!-- sheet 2 -->
        <? if ($dwg->sheet_2): ?>
            <tr>
            <td>Лист 2</td>
            <td>
                <?=$dwg->sheet_2?>
            </td>
        </tr>
        <? endif; ?>
        
        <!-- sheet 3 -->
        <? if ($dwg->sheet_3): ?>
            <tr>
            <td>Лист 2</td>
            <td>
                <?=$dwg->sheet_3?>
            </td>
        </tr>
        <? endif; ?>

        <!-- design department -->
        <tr>
            <td>Конструкторсий отдел</td>
            <td>
                <?//=$dwg->department ? $dwg->department : 'Не указан'?>
            </td>
        </tr>
        
        <!-- desinger -->
        <tr>
            <td>Конструктор</td>
            <td>
                <?//=$dwg->designer ? $dwg->desinger : 'Не указан'?>
            </td>
        </tr>
        
        <!-- date -->
        <tr>
            <td>Дата добавления</td>
            <td>
                <?=$dwg->date?>
            </td>
        </tr>

        </table>
        
        <!-- note -->
        <div class="note-dwg-works-wrp">
            <h3>Примечание</h3>
            <p><?= $dwg->note ? $dwg->note : 'записей нет'?></p>
        </div>
</div>

<!-- menu -->
<div class="sidebar-wrp">
    <?=MainMenuWidget::widget()?>
    
    <?=DrawingMenuWidget::widget(['dwg_id' => $dwg->id])?>
    
    <?=DrawingMainMenuWidget::widget()?>
</div>