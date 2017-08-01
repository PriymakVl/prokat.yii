<?php

use yii\helpers\Url;
use app\widgets\MainMenuWidget;
use app\modules\applications\models\Application;
use app\modules\applications\widgets\AppMenuWidget;
use app\modules\applications\widgets\AppActiveMenuWidget;
use app\modules\applications\widgets\AppTopMenuWidget;
use app\modules\applications\widgets\AppContentMenuWidget;

$this->registerCssFile('/css/application.css');
?>
<div class="content">
    <!-- top nenu -->
    <?=AppTopMenuWidget::widget(['app_id' => $app->id])?>
    
    <!-- info state of order -->
    <? if ($session == 'active'): ?>
        <div class="active-order">Активная заявка</div>
    <? endif; ?>
    
    <!-- order data -->
    <table>
        <tr>
            <th width="180">Наименование</th>
            <th width="545">Значение</th>
        </tr>
        <tr>
            <td colspan="2" class="text-center" style="color: green;">Данные указанные в заявке</td>
        </tr>
        <!-- number out-->
        <tr>
            <td class="text-center">Исходящий номер</td>
            <td>
                <?=$app->full_num_out ? $app->full_num_out : '<span style="color:red;">Не указан</span>';?>
            </td>
        </tr>
        <!-- number ens-->
        <tr>
            <td class="text-center">Номер в ЕНС</td>
            <td>
                <?=$app->full_num_ens ? $app->full_num_ens : '<span style="color:red;">Не указан</span>';?>
            </td>
        </tr>
        <!-- title -->
        <tr>
            <td class="text-center">Наименование заяки</td>
            <td>
                <? if ($app->content): ?>
                    <a href="<?=Url::to(['/application/content/list', 'app_id' => $app->id])?>">
                <? else: ?>
                    <?=$app->title?>
                <? endif; ?>
            </td>
        </tr>
        <!-- type repair -->
        <tr>
            <td class="text-center">Вид ремонта</td>
            <td>
                <?=$app->type?>
            </td>
        </tr>
        <!-- period -->
        <tr>
            <td class="text-center">Тип заявки</td>
            <td>
                <?=$app->period?>
            </td>
        </tr>
        <!-- department -->
        <tr>
            <td class="text-center">Кто приобретает</td>
            <td>
                <?=$app->department?>
            </td>
        </tr>
        <!-- year -->
        <tr>
            <td class="text-center">Год выпонения</td>
            <td>
                <?=$app->year ? $app->year: '<span style="color:red;">Не указан</span>'?>
            </td>
        </tr>
        <tr>
            <td colspan="2" class="text-center" style="color: green;">Дополнительные данные</td>
        </tr>
        <!-- state-->
        <tr>
            <td class="text-center">Состояние заявки</td>
            <td>
                <?=$app->state?>
            </td>
        </tr>
        <!-- category -->
        <tr>
            <td class="text-center">Категория</td>
            <td><?=$app->category?></td>
        </tr>
        <!-- customer -->
        <tr>
            <td class="text-center">Заказал</td>
            <td>
                <?=$app->customer?>
            </td>
        </tr>
        <!-- issuer -->
        <tr>
            <td class="text-center">Выдал</td>
            <td>
                <?=$app->created?>
            </td>
        </tr>
        <!-- executor -->
        <tr>
            <td class="text-center">Исполнитель</td>
            <td>
                <?=$app->executor?>
            </td>
        </tr>
        <!-- date create -->
        <tr>
            <td class="text-center">Дата создания</td>
            <td>
                <?=date('d.m.y', $app->date)?>
            </td>
        </tr>
        <!-- note -->
        <? if ($app->note): ?>
            <tr>
                <td class="text-center">Примечание</td>
                <td><?=$app->note?></td>
            </tr>
        <? endif; ?>

    </table>
</div>
<!-- menu -->
<div class="sidebar-wrp">
    <?=MainMenuWidget::widget()?>
    
    <?=AppMenuWidget::widget(['app_id' => $app->id])?>
    
    <?//=AppContentMenuWidget::widget(['app_id' => $app->id])?>
    
    <?=AppActiveMenuWidget::widget(['app_id' => $app->id])?>
</div>