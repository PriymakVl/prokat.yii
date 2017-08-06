<?php

use \yii\helpers\Url;
use \yii\web\JqueryAsset;

?>

<!-- data menu -->
<div class="top-menu">
     <a href="<?=Url::to(['/order-list', 'list_id' => $order_id])?>" <? if ($action == 'index') echo 'class="top-menu-active-link"'; ?>>Информация</a>
     <a href="<?=Url::to(['/order-list/content', 'list_id' => $order_id])?>" <? if ($action == 'content') echo 'class="top-menu-active-link"'; ?>>Содержимое</a>
     <a href="<?=Url::to(['/order-list/list'])?>">Списки заказов</a>
     <a href="javascript:history.back();">Назад</a>
</div>