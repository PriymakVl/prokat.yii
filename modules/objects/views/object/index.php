<?php

use yii\web\JqueryAsset;
use app\widgets\MainMenuWidget; 
use app\modules\objects\widgets\ObjectMenuWidget;
use app\modules\objects\widgets\ObjectSearchMenuWidget;
use app\modules\objects\widgets\ObjectTopMenuWidget;
use app\modules\lists\widgets\ListItemMenuWidget;
    
$this->registerCssFile('/css/object.css');
$this->registerJsFile('/js/object/object_copy.js', ['depends' => [JqueryAsset::className()]]);

?>
<div class="content">
    <!-- top nenu -->
    <?=ObjectTopMenuWidget::widget(['obj_id' => $obj->id])?>
    
    <!-- data object -->
    <table class="object-data">
        <tr>
            <th width="150">Наименование</th>
            <th width="565">Значение</th>
        </tr>
        
        <!-- name -->
        <tr>
            <td>Название</td>
            <td>
                <? if ($obj->child): ?>
                    <a title="<?=$obj->eng?>" href="<?=Yii::$app->urlManager->createUrl(['object/specification', 'obj_id' => $obj->id])?>"><?=$obj->name?></a>
                <? else: ?>
                    <span title="<?=$obj->eng?>"><?=$obj->name?></span>
                <? endif; ?>              
            </td>
        </tr>
        
        <!-- code-->
        <? if ($obj->code): ?>
            <tr>
                <td>Код</td>
                <td>
                    <?if($obj->dwg): ?>   
                        <a href="<?=Yii::$app->urlManager->createUrl(['object/drawing', 'obj_id' => $obj->id])?>"><?=$obj->code?></a>
                    <? else: ?>
                        <?=$obj->code?>
                    <? endif; ?>
                </td>
            </tr>
        <? endif ?>
        
        <!--  parent -->
        <tr>
            <td>Входит в состав</td>
            <td>
                <? if ($obj->parent): ?>
                    <a href="<?=Yii::$app->urlManager->createUrl(['object/specification', 'obj_id' => $obj->parent->id])?>"><?=$obj->parent->name?></a>
                <? else: ?>
                    Не указано
                <? endif; ?>
            </td>
        </tr>
        
        <!-- item -->
        <tr>
            <td>Позиция</td>
            <td>
                <?=$obj->item ? $obj->item : 'Не указана'?>
            </td>
        </tr>
        
        <!-- id object -->
        <tr>
            <td>ID объекта</td>
            <td id="obj-id" data-id="<?=$obj->id?>">
                <?=$obj->id?>
            </td>
        </tr>
        <!-- rating -->
        <tr>
            <td>Рейтинг объекта</td>
            <td>
                <?=$obj->rating?>
            </td>
        </tr>
        </table>
        
        <!-- note -->
        <div class="note-wrp">
            <h3>Примечание</h3>
            <p><?= $obj->note ? $obj->note : 'записей нет'?></p>
        </div>
</div>

<!-- menu -->
<div class="sidebar-wrp">
<?=MainMenuWidget::widget()?>
<?=ObjectSearchMenuWidget::widget()?>
<?=ObjectMenuWidget::widget(['obj_id' => $obj->id])?>
<?=ListItemMenuWidget::widget(['obj_id' => $obj->id])?>
</div> 