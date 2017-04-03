<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\widgets\MainMenuWidget;
use app\modules\drawing\widgets\DrawingMenuWidget;
use app\modules\drawing\widgets\DrawingMainMenuWidget;
use app\modules\drawing\widgets\DrawingWorksTopMenuWidget;
use app\modules\drawing\widgets\DrawingFileMenuWidget;

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
            <td>
                <? if ($dwg->type == 'folder'): ?>
                    Название папки
                <? else: ?>
                    Назание чертежа
                <? endif; ?></td>
            <td>
                <? if ($dwg->child): ?>
                    <a href="<?=Yii::$app->urlManager->createUrl(['drawing/works/specification', 'dwg_id' => $dwg->id])?>"><?=$dwg->name?></a>
                <? else: ?>
                    <?=$dwg->name?>
                <? endif; ?>              
            </td>
        </tr>
        
        <!-- number -->
        <? if ($dwg->number): ?>
            <tr>
                <td>
                    <? if ($dwg->type == 'folder'): ?>
                        Номер папки
                    <? else: ?>
                        Номер чертежа
                    <? endif; ?>
                </td>
                <td>
                    <? if($dwg->type == 'folder'): ?>
                        <?= Html::a('папка №'.$dwg->id, ['/drawing/works/folder/', 'dwg_id' => $dwg->id]) ?>
                    <? elseif(count($dwg->files) > 1): ?>
                        <?= Html::a($dwg->number, ['/drawing/works/files', 'dwg_id' => $dwg->id]) ?>
                    <? elseif($dwg->files): ?>
                        <?= Html::a($dwg->number, ['/files/works/'.$dwg->files[0]->file]) ?>
                    <? else: ?>
                        <?=$dwg->number?>
                    <? endif; ?>
                </td>
            </tr>
        <? endif ?>
        
        <!--  parent -->
        <? if ($dwg->parent): ?>
            <tr>
                <td>Сборочный чертеж</td>
                <td>
                    <a href="<?=Yii::$app->urlManager->createUrl(['drawing/works/specification', 'dwg_id' => $dwg->parent->id])?>"><?=$dwg->parent->name?></a>
                </td>
            </tr>
        <? endif; ?>
        
        <!-- item -->
        <? if ($dwg->parent): ?>
        <tr>
            <td>Позиция</td>
            <td>
                <?=$dwg->item?>
            </td>
        </tr>
        <? endif; ?>
        
        <!-- lists -->
        <tr>
            <td>Количество листов</td>
            <td>
                <?= $dwg->sheets ? $dwg->sheets : 1 ?>
            </td>
        </tr>
        
        <!-- type -->
        <tr>
            <td>Тип</td>
            <td>
                <?=$dwg->typeName?>
            </td>
        </tr>
        
        <!-- design department -->
        <? if ($dwg->department): ?>
        <tr>
            <td>Конструкторсий отдел</td>
            <td>
                <?=$dwg->department?>
            </td>
        </tr>
        <? endif; ?>
        
        <!-- desinger -->
        <? if ($dwg->designer): ?>
        <tr>
            <td>Конструктор</td>
            <td>
                <?=$dwg->designer?>
            </td>
        </tr>
        <? endif; ?>
        
        <!-- date -->
        <tr>
            <td>Дата добавления</td>
            <td>
                <?=$dwg->date?>
            </td>
        </tr>

        <!-- id drawing -->
        <tr>
            <td>ID Dwg</td>
            <td id="obj-id">
                <?=$dwg->id?>
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
    
    <?=DrawingFileMenuWidget::widget(['dwg_id' => $dwg->id])?>
</div>