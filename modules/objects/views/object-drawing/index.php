<?php 
    use \yii\web\JqueryAsset;
    use yii\widgets\ActiveForm;
    use app\widgets\MainMenuWidget; 
    use app\widgets\FlashMessageWidget;
    use app\modules\objects\widgets\ObjectTopMenuWidget; 
    use app\modules\objects\widgets\ObjectSearchMenuWidget; 
    use app\modules\objects\widgets\ObjectDrawingWidget;
    use app\modules\objects\widgets\ObjectDrawingMenuWidget;
    
    $this->registerCssFile('/css/drawing.css');
    $this->registerJsFile('/js/object/object_file_add_order.js');

?>

<div class="content">
    <!-- top nenu -->
    <?=ObjectTopMenuWidget::widget(['obj_id' => $obj->id])?>
    
    <!-- info -->
    <div class="info-box margin-top-15">
        <span>Название:</span>&laquo; <?=$obj->name?> &raquo;<br />
        <span>Код:</span>&laquo; <?=$obj->code ? $obj->code : 'Не указан'?> &raquo;
    </div>
    
    <!-- flash messge -->
    <?=FlashMessageWidget::widget()?>
    
    <!-- full note-->
    <div class="note-full" style="display: none;">
        <h4>Полный текст примечания:</h4>
        <p></p>
        <a href="#" onclick="return false;" id="note-hide">закрыть</a>
    </div>
        
    <!-- drawings list -->   
    <div id="dwg-list-wrp" style="width: 720px;">
        <? if ($drawings): ?>
            <!-- drawing Danieli -->
            <? if ($drawings['danieli']): ?>
                <?=ObjectDrawingWidget::widget(['drawings' => $drawings['danieli'], 'category' => 'danieli', 'obj_id' => $obj->id])?>
           <? endif; ?>
           
            <!-- drawing works -->
            <? if ($drawings['works']): ?>
                <?=ObjectDrawingWidget::widget(['drawings' => $drawings['works'], 'category' => 'works', 'obj_id' => $obj->id])?> 
            <? endif; ?>
            
            <!-- drawing department -->
            <? if ($drawings['department']): ?>
                <?=ObjectDrawingWidget::widget(['drawings' => $drawings['department'], 'category' => 'department', 'obj_id' => $obj->id])?>
            <? endif; ?>
            
            <!-- drawing standard danieli -->
            <? if ($drawings['standard_danieli']): ?>
                <?=ObjectDrawingWidget::widget(['drawings' => $drawings['standard_danieli'], 'category' => 'standard_danieli', 'obj_id' => $obj->id])?>
            <? endif; ?>
            
            <!-- drawing Sundbirsta -->
            <? if ($drawings['sundbirsta']): ?>
                <?=ObjectDrawingWidget::widget(['drawings' => $drawings['sundbirsta'], 'category' => 'sundbirsta', 'obj_id' => $obj->id])?>
            <? endif; ?>
        <? else: ?>
            <div class="alert alert-danger margin-top-15">Чертежей нет</div>
        <? endif; ?> 
    </div>
</div>
    
<!-- menu -->
<div class="sidebar-wrp">
    <?=MainMenuWidget::widget()?>
    <?=ObjectSearchMenuWidget::widget()?>
    <?=ObjectDrawingMenuWidget::widget(['obj_id' => $obj->id])?>
</div> 
