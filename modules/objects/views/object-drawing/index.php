<?php 
    use \yii\web\JqueryAsset;
    use yii\widgets\ActiveForm;
    use app\widgets\MainMenuWidget; 
    use app\modules\objects\widgets\ObjectTopMenuWidget; 
    use app\modules\objects\widgets\ObjectSearchMenuWidget; 
    use app\modules\objects\widgets\ObjectDrawingWidget;
    use app\modules\objects\widgets\ObjectDrawingMenuWidget;
    
    $this->registerCssFile('css/drawing.css');
    $this->registerJsFile('js/drawing/dwg_revision_toggle.js',  ['depends' => [JqueryAsset::className()]]);
    
?>

<div class="content">
    <!-- top nenu -->
    <?=ObjectTopMenuWidget::widget(['obj_id' => $obj->id])?>
    
    <!-- info -->
    <div class="info-box">
        <span>Название:</span>&laquo; <?=$obj->name?> &raquo;<br />
        <span>Код:</span>&laquo; <?=$obj->code ? $obj->code : 'Не указан'?> &raquo;
    </div>
    
    <!-- full note-->
    <div class="note-full" style="display: none;">
        <h4>Полный текст примечания:</h4>
        <p></p>
        <a href="#" onclick="return false;" id="note-hide">закрыть</a>
    </div>
        
    <!-- drawings list -->   
    <div id="dwg-list-wrp" style="width: 720px;">
        <? if ($drawings): ?>
            <!-- drawing vendor -->
            <?//=ObjectDrawingWidget::widget(['drawings' => $drawings, 'category' => 'vendor', 'obj_id' => $obj->id])?>
           
           <!-- drawing works -->
            <?//=ObjectDrawingWidget::widget(['drawings' => $drawings, 'category' => 'works', 'obj_id' => $obj->id])?> 
            
            <!-- drawing department -->
            <?=ObjectDrawingWidget::widget(['drawings' => $drawings, 'category' => 'department', 'obj_id' => $obj->id])?>
            
            <!-- drawing standard -->
            <?//=ObjectDrawingWidget::widget(['drawings' => $drawings, 'category' => 'standard', 'obj_id' => $obj->id])?>

        <? else: ?>
            <div class="alert-danger">Чертежей нет</div>
        <? endif; ?> 
    </div>
</div>
    
<!-- menu -->
<div class="sidebar-wrp">
    <?=MainMenuWidget::widget()?>
    <?=ObjectSearchMenuWidget::widget()?>
    <?=ObjectDrawingMenuWidget::widget(['obj_id' => $obj->id])?>
</div> 
