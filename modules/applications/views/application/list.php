<?php

use \yii\web\JqueryAsset;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use Yii\helpers\Url;
use yii\widgets\LinkPager;
use app\widgets\MainMenuWidget;
use app\modules\applications\widgets\AppMenuWidget;
use app\modules\applications\widgets\AppActiveMenuWidget;
use app\modules\applications\widgets\AppListMenuWidget;
use app\modules\applications\widgets\AppTopListMenuWidget;

$this->registerCssFile('/css/application.css');

?>
<div class="content">
    <!-- title -->
    <div class="title-box">Перечень заявок</div>
    
    <!-- top nenu -->
    <?=AppTopListMenuWidget::widget(['params' => $params])?>
    
    <!-- data of application -->
    <table id="app-list">
        <tr>
            <th width="30">
                <input type="checkbox" name="app" id="checked-all" />
            </th>
            <th width="40">№</th>
            <th width="60" class="text-center">Отдел</th>
            <th width="60">Исх №</th>
            <th width="60" class="text-center">ЕНС №</th>        
            <th width="470">Наименование</th>
        </tr>
        <? if ($list): ?>
            <? $number = $number ? $number : 1; ?>
            <? foreach ($list as $app): ?>
                <tr>
                    <td>
                        <input type="checkbox" name="app" app_id="<?=$app->id?>" />
                    </td>
                    <td class="text-center">
                        <?=$number?>
                    </td>
                    <td class="text-center">
                        <a href="<?=Url::to(['/application', 'app_id' =>$app->id])?>"><?=$app->department ? $app->department : 'Не указан'?></a>
                    </td>
                    <td class="text-center">
                       <?=$app->number_out?>
                    </td>
                    <td class="text-center">
                        <?=$app->number_ens?>
                    </td>
                    <td>
                        <a href="<?=Url::to(['/application/content/list', 'app_id' =>$app->id])?>"><?=$app->title?></a>
                    </td>
                </tr>
                <? $number++; ?>
            <? endforeach; ?>
        <? else: ?>
            <tr>
                <td colspan="6" class="not-content">Заявок нет</td>
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
    <?=AppListMenuWidget::widget(['state' => $state])?>
    <?=AppActiveMenuWidget::widget()?>
</div>