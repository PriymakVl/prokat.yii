<?php 

use \yii\web\JqueryAsset;
use yii\widgets\ActiveForm;
use app\components\other\MainMenuWidget; 
use app\modules\standard\components\StandardTopMenuWidget; 
use app\modules\standard\components\StandardMenuWidget;

$this->registerCssFile('css/standard.css');

?>

<div class="content">
    <!-- top nenu -->
    <?=StandardTopMenuWidget::widget(['std_id' => $std->id])?>
    
        <!-- info -->
        <div class="info-box">
            <span>Название стандарта:</span>&laquo; <?=$std->name?> &raquo;<br />
            <span>Номер стандарта:</span>&laquo; <?=$std->number ? $std->number : 'Не указано'?> &raquo;
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
                <th width="150">Файл</th>
                <th width="535">Примечание</th>
            </tr>
            <? if($std->files): ?>
            <? foreach($std->files as $file): ?>
                <tr>
                    <td>
                        <input type="radio" name="file" file_id="<?=$file->id?>" std_id="<?=$std->id?>" />
                    </td>
                    <td class="text-center">
                        <a target="_blank" href="<?=Yii::$app->urlManager->createUrl(['files/standard/other/'.$file->file])?>"><?=$file->file?></a>                                
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
    
    <?=StandardMenuWidget::widget()?>
</div> 
