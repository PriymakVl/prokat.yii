<?php 
    use \yii\web\JqueryAsset;
    use yii\widgets\ActiveForm;
    use app\widgets\MainMenuWidget; 
    use app\modules\objects\widgets\ObjectTopMenuWidget; 
    use app\modules\objects\widgets\ObjectSearchMenuWidget; 
    use app\modules\objects\widgets\ObjectDrawingWidget;
    use app\modules\objects\widgets\ObjectDrawingMenuWidget;
    
    $this->registerCssFile('css/drawing.css');
    $this->registerJsFile('js/drawing/dwg_add_object.js',  ['depends' => [JqueryAsset::className()]]);
    $this->registerJsFile('js/drawing/dwg_delete_object.js',  ['depends' => [JqueryAsset::className()]]);
    $this->registerJsFile('js/drawing/dwg_note_object.js',  ['depends' => [JqueryAsset::className()]]);
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
        <table>        
            <tr>
                <th width="30"><input type="radio" disabled="disabled" /></th>
                <th width="120">Создал</th>
                <th width="80">Редакция</th>
                <th width="60">Листов</th>
                <th width="50">Лист</th>
                <th width="150">Файл</th>
                <th>Примечание</th>
            </tr>
            <? if ($drawings): ?>
                <!-- drawing vendor -->
                <?=ObjectDrawingWidget::widget(['drawings' => $drawings, 'category' => 'vendor', 'obj_id' => $obj->id])?>
               
               <!-- drawing works -->
                <?=ObjectDrawingWidget::widget(['drawings' => $drawings, 'category' => 'works', 'obj_id' => $obj->id])?> 
                
                <!-- drawing department -->
                <?=ObjectDrawingWidget::widget(['drawings' => $drawings, 'category' => 'department', 'obj_id' => $obj->id])?>
                
                <!-- drawing standard -->
                <?=ObjectDrawingWidget::widget(['drawings' => $drawings, 'category' => 'standard', 'obj_id' => $obj->id])?>
            <? else: ?>
                <tr>
                    <td colspan="7" class="not-content">Чертежей нет</td>
                </tr>
            <? endif; ?>
        </table> 
    </div>
</div>
    
<!-- menu -->
<div class="sidebar-wrp">
    <?=MainMenuWidget::widget()?>
    <?=ObjectSearchMenuWidget::widget()?>
    <?=ObjectDrawingMenuWidget::widget(['obj_id' => $obj->id])?>
</div> 
