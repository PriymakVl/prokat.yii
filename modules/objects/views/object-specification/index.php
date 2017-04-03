<?php  

use yii\web\JqueryAsset;
use yii\helpers\Url;
use app\widgets\MainMenuWidget;
use app\modules\objects\widgets\ObjectMenuWidget;
use app\modules\objects\widgets\ObjectSearchMenuWidget;
use app\modules\objects\widgets\ObjectListMenuWidget;
use app\modules\objects\widgets\ObjectTopMenuWidget;
use app\modules\objects\widgets\ObjectListChildrenWidget;

$this->registerCssFile('css/specification.css');
    
?>
<div class="content">
    <!-- top nenu -->
    <?=ObjectTopMenuWidget::widget(['obj_id' => $parent->id])?>
    
    <!-- info -->
    <div class="info-box">
        <span>Название:</span>&laquo; <?=$parent->name?> &raquo;
        <? if ($parent->code): ?>
            <br />
            <span>Код:</span>&laquo; <?=$parent->code?> &raquo;
        <? endif; ?>
        <!-- parent id -->
        <input type="hidden" value="<?=$parent->id?>" id="parent-id"/>
    </div>
    
    <!-- specification -->
    <table>
        <tr>
                <th width="30"><input type="checkbox" id="checked-all" /></th>
                <th width="50">Поз</th>
                <th width="470">Наименование</th>
                <th width="170">Код</th>
        </tr>
        <? if ($children['standard'] || $children['unit'] || $children['category']): ?>      
            <!-- standart --> 
            <?=ObjectListChildrenWidget::widget(['children' => $children['standard'], 'color' => 'grey'])?>    
                 
            <!-- unit -->
            <?=ObjectListChildrenWidget::widget(['children' => $children['unit']])?> 
             
            <!-- category -->
            <?=ObjectListChildrenWidget::widget(['children' => $children['category']])?> 
            
        <!-- not specification -->  
        <? else: ?>
        <tr>
            <td colspan="4" class="not-content">Спецификации нет</td>
        </tr>
        <? endif; ?>
    </table>
</div>

<!-- menu -->
<div class="sidebar-wrp">
    <?=MainMenuWidget::widget()?>
    <?=ObjectSearchMenuWidget::widget()?>
    <?=ObjectListMenuWidget::widget(['obj_id' => $parent->id])?>
</div> 