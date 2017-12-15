<?php
    use yii\helpers\Url;
    
    $this->registerJsFile('/js/drawing/dwg_draft_update.js');
    $this->registerJsFile('/js/drawing/dwg_draft_delete.js');
?>
<div  class="sidebar-menu" id="dwg-list-menu">
    <h5>
        <? if ($category == 'department') echo 'Эскизы'; ?>
        <? if ($category == 'works') echo 'Чертежи ПКО'; ?>
    </h5>   
    <ul >
        <? if ($category == 'department'): ?>
            <li><a href="<?=Url::to('/drawing/department/form')?>" >Добавить эскиз</a></li>
            <li><a href="#" onclick="return false;" id="draft-update">Редактировать эскиз</a></li>
            <li><a href="#" onclick="return false;" id="draft-delete" >Удалить эскиз</a></li>
        <? elseif ($category == 'works'): ?>
            <li><a href="<?=Url::to('/drawing/works/form')?>" >Добавить чертеж ПКО</a></li>
        <? endif; ?>
        
    </ul>
</div>