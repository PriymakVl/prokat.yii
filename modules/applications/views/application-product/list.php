<?php

use \yii\web\JqueryAsset;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use Yii\helpers\Url;
use yii\widgets\LinkPager;
use app\widgets\MainMenuWidget;
use app\modules\applications\widgets\AppMenuWidget;
use app\modules\applications\widgets\AppProductListMenuWidget;
use app\modules\applications\widgets\AppProductTopListMenuWidget;

$this->registerCssFile('/css/application.css');

?>
<div class="content">
    <!-- title -->
    <div class="title-box">Перечень продуктов</div>
    
    <!-- top nenu -->
    <?=AppTopProductListMenuWidget::widget(['params' => $params])?>
    
    <!-- data of application product-->
    <table id="product-list">
        <tr>
            <th width="30">
                <input type="checkbox" name="product" id="checked-all" />
            </th>
            <th width="40">№</th>
            <th width="60" class="text-center">Отдел</th> 
			<th width="60" class="text-center">Категория</th>			
            <th width="470">Наименование</th>
        </tr>
        <? if ($list): ?>
            <? $number = $number ? $number : 1; ?>
            <? foreach ($list as $product): ?>
                <tr>
                    <td>
                        <input type="checkbox" name="app" product_id="<?=$app->id?>" />
                    </td>
                    <td class="text-center">
                        <?=$number?>
                    </td>
                    <td class="text-center">
                        <?=$product->department ? $app->department : 'Не указан'?>
                    </td>
					<td class="text-center">
                        <?=$product->category ? $app->category : 'Не указана'?>
                    </td>
                    <td>
                        <a href="<?=Url::to(['/application/product/list', 'product_id' =>$product->id])?>"><?=$product->name?></a>
                    </td>
                </tr>
                <? $number++; ?>
            <? endforeach; ?>
        <? else: ?>
            <tr>
                <td colspan="5" class="not-content">Продуктов еще нет</td>
            </tr>
        <? endif; ?>
    </table>
    <!-- pagination -->
    <div class="pagination-wrp">
        <?=LinkPager::widget(['pagination' => $pages])?>    
    </div><!-- class pagination-wrp -->
</div><!-- class content -->

<!-- menu -->
<div class="sidebar-wrp">
    <?=MainMenuWidget::widget()?>
    <?//=AppMenuWidget::widget()?>
    <?=AppProductMenuWidget::widget()?>
	<?=AppProductTopListMenuWidget::widget()?>
</div>