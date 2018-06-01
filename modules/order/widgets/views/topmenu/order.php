<?php

use \yii\helpers\Url;
use app\modules\order\models\Order;

$class_active_info = ($controller == 'order' && $action == 'index') ? 'top-menu-active-link' : '';
$class_active_content = ($controller == 'order-content' && $action == 'list') ? 'top-menu-active-link' : '';
$class_active_work = ($controller == 'order' && $action == 'work') ? 'top-menu-active-link' : '';
$class_active_acts = ($controller == 'order' && $action == 'acts') ? 'top-menu-active-link' : '';
?>

<!-- data menu -->
<div class="top-menu">
    <!-- info order tab -->
     <a href="<?=Url::to(['/order', 'order_id' => $order_id])?>" class="<?=$class_active_info?>">Информация</a>
    <!-- content order tab -->
     <a href="<?=Url::to(['/order/content/list', 'order_id' => $order_id])?>" class="<?=$class_active_content?>">Содержимое</a>
    <!-- work order tab -->
     <a href="<?=Url::to(['/order/work', 'order_id' => $order_id])?>" class="<?=$class_active_work?>">Характер работы</a>
    <!-- order acts tab -->
     <a href="<?=Url::to(['/order/acts', 'order_id' => $order_id])?>" class="<?=$class_active_acts?>">Акты (<?=$count_acts?>)</a>
    <!-- drafts orders tab -->
     <a href="<?=Url::to(['/orders', 'state' => Order::STATE_DRAFT])?>">Черновики</a>
    <!-- come back -->
     <a href="javascript:history.back();">Назад</a>
</div>