<?php

use \yii\helpers\Url;
use \yii\web\JqueryAsset;

?>

<!-- data menu -->
<div class="top-menu">
     <a href="<?=Url::to(['/order', 'order_id' => $order_id])?>" <? if ($action == 'index' || $action == 'draft') echo 'class="top-menu-active-link"'; ?>>Информация</a>
     <a href="<?=Url::to(['/order/content/list', 'order_id' => $order_id])?>" <? if ($action == 'content') echo 'class="top-menu-active-link"'; ?>>Содержимое</a>
     <a href="<?=Url::to(['/order/work', 'order_id' => $order_id])?>" <? if ($action == 'work') echo 'class="top-menu-active-link"'; ?>>Характер работы</a>
     <a href="<?=Url::to(['/order/list'])?>">Заказы</a>
     <a href="<?=Url::to(['/order/drafts/list'])?>">Черновики</a>
     <a href="javascript:history.back();">Назад</a>
</div>