<?php  

use yii\web\JqueryAsset;
use yii\helpers\Url;
use app\widgets\MainMenuWidget;
use app\modules\objects\widgets\ObjectMenuWidget;
use app\modules\objects\widgets\ObjectSearchMenuWidget;
use app\modules\objects\widgets\ObjectListMenuWidget;
use app\modules\objects\widgets\ObjectListTopFiltersWidget;
use app\modules\objects\widgets\ObjectTopMenuWidget;
use app\modules\objects\widgets\ObjectListChildrenWidget;
use app\modules\objects\widgets\ObjectListSortMenuWidget;

$this->registerCssFile('/css/specification.css');
$this->registerJsFile('/js/object/specif_show_type_details.js');
    
?>
<div class="content">
    <!-- top menu -->
    <?=ObjectTopMenuWidget::widget(['obj_id' => $parent->id])?>
    
    <!-- info -->
    <div class="info-box margin-top-15">
        <span>Название:</span>&laquo; <?=$parent->name?> &raquo;
        <? if ($parent->code): ?>
            <span>Код:</span>&laquo; <?=$parent->code?> &raquo;
        <? endif; ?>
        <!-- parent id -->
        <input type="hidden" value="<?=$parent->id?>" id="parent-id"/>
    </div>

    <!-- filters box -->
    <?=ObjectListTopFiltersWidget::widget(['sort' => $sort, 'obj_id' => $parent->id])?>
    
    <!-- specification -->
    <table class="margin-top-15">
        <tr>
                <th width="30"><input type="checkbox" id="checked-all" /></th>
                <th width="50">Поз</th>
                <th width="470">Наименование</th>
                <th width="170">Код</th>
        </tr>
        <? if ($children['standard'] || $children['unit'] || $children['category']): ?>      
            <!-- standart --> 
            <?=ObjectListChildrenWidget::widget(['children' => $children['standard'], 'color' => 'grey', 'type' => 'standard'])?>    
                 
            <!-- unit -->
            <?=ObjectListChildrenWidget::widget(['children' => $children['unit'], 'type' => 'unit'])?> 
             
            <!-- category -->
            <?=ObjectListChildrenWidget::widget(['children' => $children['category'], 'type' => 'category'])?> 
            
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
    <?//=ObjectListSortMenuWidget::widget(['sort' => $sort])?>
    <?=ObjectSearchMenuWidget::widget()?>
    <?=ObjectListMenuWidget::widget(['obj_id' => $parent->id])?>
</div> 