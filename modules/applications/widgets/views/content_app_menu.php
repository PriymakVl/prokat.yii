<?php

use \yii\helpers\Url;
use \yii\web\JqueryAsset;

//$this->registerJsFile('js/order/item_list_delete.js', ['depends' => JqueryAsset::className()]);
//$this->registerJsFile('js/order/item_list_set_parent.js', ['depends' => JqueryAsset::className()]);
?>
<div  class="sidebar-menu">
    <h5>'Элемент заявки'</h5>   
    <ul>
		<li>
			<a href="<?=Url::to(['/application/content/form', 'app_id' => $app_id])?>">Добавить элемент</a>
		</li>
		<? if ($item_id): ?>
			<li>
				<a href="<?=Url::to(['/application/content/form', 'item_id' => $item_id, 'app_id' => $app_id])?>">Редактировать элемент</a>
			</li>
			<li>
				<a href="<?=Url::to(['/application/content/item/delete', 'item_id' => $item_id, 'app_id' => $app_id])?>">Удалить элемент</a>
			</li>
		<? endif; ?>
	</ul>
</div>