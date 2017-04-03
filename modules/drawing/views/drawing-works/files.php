<?php 

use \yii\web\JqueryAsset;
use app\widgets\MainMenuWidget; 
use app\modules\drawing\widgets\DrawingWorksTopMenuWidget; 
use app\modules\drawing\widgets\DrawingMainMenuWidget;
use app\modules\drawing\widgets\DrawingFileMenuWidget;
use app\modules\drawing\widgets\DrawingMenuWidget;

$this->registerCssFile('css/drawing.css');
$this->registerJsFile('js/drawing/dwg_works_file_delete.js',  ['depends' => [JqueryAsset::className()]]);
$this->registerJsFile('js/drawing/dwg_works_file_update.js',  ['depends' => [JqueryAsset::className()]]);

?>

<div class="content">
    <!-- top nenu -->
    <?=DrawingWorksTopMenuWidget::widget(['dwg' => $dwg])?>
    
        <!-- info -->
        <div class="info-box">
            <span>Название чережа:</span>&laquo; <?=$dwg->name?> &raquo;<br />
            <span>Номер чертежа:</span>&laquo; <?=$dwg->number?> &raquo;
        </div>
        
        <!-- full note-->
        <div class="note-full" style="display: none;">
            <h4>Полный текст примечания:</h4>
            <p></p>
            <a href="#" onclick="return false;" id="note-hide">закрыть</a>
        </div>
        
     <!-- file list -->   
    <div id="file-list-wrp">
        <table>        
            <tr>
                <th width="30"><input type="radio" disabled="disabled" /></th>
                <th width="120">№ листа</th>
                <th width="150">Файл</th>
                <th width="420">Примечание</th>
            </tr>
            <? if($dwg->files): ?>
            <? foreach($dwg->files as $file): ?>
                <tr>
                    <td>
                        <input type="radio" name="file" file_id="<?=$file->id?>" dwg_id="<?=$dwg->id?>" />
                    </td>
                    <td class="text-center">
                        <span>лист </span><?=$file->sheet?>
                    </td>
                    <td class="text-center">
                        <a target="_blank" href="<?=Yii::$app->urlManager->createUrl(['files/works/'.$file->file])?>"><?=$file->file?></a>                                
                    </td>
                    <td>
                        <? if($file->cutNote): ?>
                            <span class="note-cut" note="<?=$file->note?>" title="показать полный текст примечания"><?=$file->cutNote?></span>
                        <? else: ?>
                            <?=$file->note?> 
                        <? endif; ?>   
                    </td>
                </tr>
            <? endforeach; ?>
            <? else: ?>
            <tr>
                <td colspan="6" class="not-content">Файлов нет</td>
            </tr>
            <? endif; ?>
        </table> 
    </div>
</div>
    
<!-- menu -->
<div class="sidebar-wrp">
    <?=MainMenuWidget::widget()?>
    
    <?=DrawingMainMenuWidget::widget()?>
    
    <?=DrawingMenuWidget::widget(['dwg_id' => $dwg->id])?>
    
    <?=DrawingFileMenuWidget::widget(['dwg_id' => $dwg->id])?>
</div> 
