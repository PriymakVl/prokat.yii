<?
use app\modules\orderact\models\OrderAct;
use app\modules\order\models\Order;

?>
<div id="order-act-form-tab-items" style="display: none;">

    <!-- edit items -->
    <table class="content-order-act">
        <tr>
            <th width="40">№</th>
            <th width="100">Код</th>
            <th width="150">Наименование</th>
            <th width="60">Кол-во</th>
            <th>Зказал</th>
        </tr>
        <? if (empty($content)): ?>
        <tr>
            <td colspan="5" align="center">
                <span style="color:red;">Содержимого акта еще нет</span>
            </td>
        <tr>
        <? else:
        $number = 1;
        foreach ($content as $item): ?>
            <tr>
                <td align="center"><?=$number?></td>
                <td align="center"><?=$item->drawing?></td>
                <td align="center"><?=$item->name?></td>
                <td class="center td-count-field">
                    <?=$f->field($form, 'items_num['.$item->id.']')->textInput(['value' => $item->count, 'class' => 'count-item'])->label(false)?>
                </td>
                <td align="center"><?=$item->customer?></td>
            </tr>
        <? $number++; endforeach; endif; ?>
    </table>

</div><!-- /order-act-form-tab-items -->