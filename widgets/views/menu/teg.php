<?php
    use \yii\web\JqueryAsset;
    
    $this->registerJsFile('js/list/list_type_delete.js',  ['depends' => [JqueryAsset::className()]]);
    $this->registerJsFile('js/list/list_type_update.js',  ['depends' => [JqueryAsset::className()]]);
?>

<div class="sidebar-menu" id="list-type-menu">
    <h5>Типы списка</h5>
    <ul>
        <? if (!$flag): ?>
            <li>
                <a href="<?=Yii::$app->urlManager->createUrl(['listtype'])?>">Список типов</a>
            </li>
        <? endif; ?>
        <li>
            <a href="<?=Yii::$app->urlManager->createUrl(['listtype/form'])?>">Создать тип</a>
        </li>
        <? if ($flag): ?>
            <li>
                <a href="#" onclick="return false;" id="list-type-update">Редактировать тип</a>
            </li>
            <li>
                <a href="#" onclick="return false;" id="list-type-delete">Удалить тип</a>
            </li>
        <? endif; ?>
    </ul>
</div>