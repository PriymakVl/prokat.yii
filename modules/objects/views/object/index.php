<?php

use yii\web\JqueryAsset;
use yii\helpers\Url;
use app\widgets\MainMenuWidget; 
use app\modules\objects\widgets\ObjectMenuWidget;
use app\modules\objects\widgets\ObjectSearchMenuWidget;
use app\modules\objects\widgets\ObjectTopMenuWidget;
use app\modules\lists\widgets\ListItemMenuWidget;
use app\modules\order\models\Order;
use app\widgets\FlashMessageWidget;
    
$this->registerCssFile('/css/object.css');
$this->registerJsFile('/js/object/object_copy.js');

?>
<div class="content">
    <!-- top nenu -->
    <?=ObjectTopMenuWidget::widget(['obj_id' => $obj->id])?>

    <!-- flash messge -->
    <?=FlashMessageWidget::widget()?>
    
    <!-- data object -->
    <table class="object-data margin-top-15">
        <tr>
            <th width="150">Наименование</th>
            <th width="565">Значение</th>
        </tr>
        
        <!-- name -->
        <tr>
            <td>Название</td>
            <td>
                <? if ($obj->child): ?>
                    <a title="<?=$obj->eng?>" href="<?=Yii::$app->urlManager->createUrl(['object/specification', 'obj_id' => $obj->id])?>"><?=$obj->name?></a>
                <? else: ?>
                    <span title="<?=$obj->eng?>"><?=$obj->name?></span>
                <? endif; ?>              
            </td>
        </tr>
		
		<!-- dimensions -->
		<? if ($obj->dimensions): ?>
			<tr>
				<td>Габарит. размеры</td>
				<td>
					<?=$obj->dimensions?>             
				</td>
			</tr>
		<? endif; ?>
        
        <!-- code-->
        <? if ($obj->code): ?>
            <tr>
                <td>Код</td>
                <td>
                    <? if($obj->pathDwg): ?>
                        <a href="<?=Url::to([$obj->pathDwg])?>" target="_blank"><?=$obj->code ? $obj->code : 'не указан'?></a>     
                    <? elseif ($obj->numberDwg): ?>
                        <a href="<?=Url::to(['/object/drawing', 'obj_id' => $obj->id])?>"><?=$obj->code ? $obj->code : 'не указан'?></a>
                    <? else: ?>
                        <?=$obj->code ? $obj->code : 'не указан'?>
                    <? endif; ?>  
                </td>
            </tr>
        <? endif ?>
        
        <!--  parent -->
        <tr>
            <td>Входит в состав</td>
            <td>
                <? if ($obj->parent): ?>
                    <a href="<?=Yii::$app->urlManager->createUrl(['object/specification', 'obj_id' => $obj->parent->id])?>"><?=$obj->parent->name?></a>
                <? else: ?>
                    Не указано
                <? endif; ?>
            </td>
        </tr>
        
        <!-- item -->
        <tr>
            <td>Позиция</td>
            <td>
                <?=$obj->item ? $obj->item : 'Не указана'?>
            </td>
        </tr>
        
        <!-- count of objects -->
        <tr>
            <td>Количество</td>
            <td>
                <?=$obj->qty?>
            </td>
        </tr>
        
        <!-- weight of objects -->
        <tr>
            <td>Вес</td>
            <td>
                <?=$obj->weight ? $obj->weight.'кг' : 'Не указан'?>
            </td>
        </tr>
        
        <? if ($obj->type == 'detail'): ?>
            <!-- material of object -->
            <tr>
                <td>Материал</td>
                <td>
                    <?=$obj->material ? $obj->material : 'Не указан'?>
                </td>
            </tr>
            <? if ($obj->analog): ?>
                 <!-- analog of object -->
                <tr>
                    <td>Аналог материала</td>
                    <td>
                        <?=$obj->analog?>
                    </td>
                </tr>
            <? endif; ?>
        <? endif; ?>
        
        <!-- orders -->
        <? if ($obj->orders): ?>
            <tr>
                <td>
                    <a href="<?=Url::to(['/object/orders', 'obj_id' => $obj->id])?>">Заказы</a>
                </td>
                <td>
                    <?
                        $limit = 1;
                        foreach ($obj->orders as $order) {
                            if ($order->state == Order::STATE_CLOSED) continue;
                            if ($limit > 6) {
                                echo '<a href="#">Все заказы</a>';
                                break;
                            }
                            $color = $order->state == Order::STATE_PERFORMED ? 'orange' : 'black';
                            echo '<a style="color:'.$color.'" href="'.Url::to(['/order/content/list', 'order_id' =>$order->id]).'" title="'.$order->name.'" target="_blank">№'.$order->number.'</a>&nbsp;&nbsp;';
                            $limit++;
                        }
                    ?>
                </td>
            </tr>
            
            <!-- reserve -->
            <tr>
                <td>
                    <a href="<?=Url::to(['/product/manufactured', 'code' =>$obj->code])?>">Резерв</a>
                </td>
                <td><?=$obj->reserve ? '<span style="color:green;">'.$obj->reserve.'шт.</span>': '<span style="color:red">Нет</span>'?></td>
            </tr>
        <? endif; ?>
        </table>
        
        <!-- note -->
        <? if ($obj->note): ?>
            <div class="note-wrp">
                <h3>Примечание</h3>
                <p><?=$obj->note?></p>
            </div>
        <? endif; ?>

</div>

<!-- menu -->
<div class="sidebar-wrp">
<?=MainMenuWidget::widget()?>
<?=ObjectSearchMenuWidget::widget()?>
<?=ObjectMenuWidget::widget(['obj' => $obj])?>
</div> 