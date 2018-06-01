<?php 
    use yii\web\View;
    use app\widgets\MainMenuWidget; 
    use app\widgets\FlashMessageWidget;
    use app\modules\objects\widgets\ObjectTopMenuWidget; 
    use app\modules\objects\widgets\ObjectSearchMenuWidget;
    
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
                <?=View::render('tab/danieli', ['obj_id' => $obj->id, 'drawings' => $drawings['danieli']])?>
           <? endif; ?>
           
            <!-- drawing works -->
            <? if ($drawings['works']): ?>
                <?=View::render('tab/works', ['obj_id' => $obj->id, 'drawings' => $drawings['works']])?>
            <? endif; ?>
            
            <!-- drawing department -->
            <? if ($drawings['department']): ?>
                <?=View::render('tab/department', ['obj_id' => $obj->id, 'drawings' => $drawings['department']])?>
            <? endif; ?>
            
            <!-- drawing standard danieli -->
            <? if ($drawings['standard_danieli']): ?>
                <?=View::render('tab/standard_danieli', ['obj_id' => $obj->id, 'drawings' => $drawings['standard_danieli']])?>
            <? endif; ?>
            
            <!-- drawing Sundbirsta -->
            <? if ($drawings['sundbirsta']): ?>
                <?=View::render('tab/sundbirsta', ['obj_id' => $obj->id, 'drawings' => $drawings['sundbirsta']])?>
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
    <?=View::render('menu', ['obj_id' => $obj->id])?>
</div> 
