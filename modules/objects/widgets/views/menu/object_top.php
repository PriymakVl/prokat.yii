<?php

use \yii\web\JqueryAsset;
use \yii\helpers\Url;

$this->registerJsFile('js/object/object_delete.js',  ['depends' => [JqueryAsset::className()]]);
$this->registerJsFile('js/object/object_update.js',  ['depends' => [JqueryAsset::className()]]);

?>

<!-- data menu -->
<div class="top-menu">
     <a href="<?=Url::to(['/object', 'obj_id' => $obj_id])?>" <? if ($page == 'object') echo 'class="top-menu-active-link"'; ?>>Информация</a>
     <a href="<?=Url::to(['/object/specification', 'obj_id' => $obj_id])?>" <? if ($page == 'specification') echo 'class="top-menu-active-link"'; ?>>Спецификация</a>
     <a href="<?=Url::to(['/object/drawing', 'obj_id' => $obj_id])?>" <? if ($page == 'drawing') echo 'class="top-menu-active-link"'; ?>>Чертежи</a>
     <a href="javascript:history.back();">Назад</a>
</div>