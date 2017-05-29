<?php

use \yii\helpers\Url;
use \yii\web\JqueryAsset;
use app\modules\applications\models\Application;

?>

<!-- data menu -->
<div class="top-menu">
     <a href="<?=Url::to(['/application', 'app_id' => $app_id])?>" <? if ($action == 'index') echo 'class="top-menu-active-link"'; ?>>Информация</a>
     <a href="<?=Url::to(['/application/content/list', 'app_id' => $app_id])?>" <? if ($action == 'content') echo 'class="top-menu-active-link"'; ?>>Содержимое</a>
     <a href="<?=Url::to(['/application/document/list', 'app_id' => $app_id])?>" <? if ($action == 'document') echo 'class="top-menu-active-link"'; ?>>Связанные документы</a>
     <a href="<?=Url::to(['/application/list'])?>">Заявки</a>
     <a href="<?=Url::to(['/application/list', 'state' => Application::STATE_APP_DRAFT])?>">Черновики</a>
     <a href="javascript:history.back();">Назад</a>
</div>