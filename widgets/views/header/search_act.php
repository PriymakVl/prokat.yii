<?php

$this->registerJsFile('/js/total/change_search.js');
 
$act_num = \Yii::$app->session->getFlash('act_num');
$dwg_num = \Yii::$app->session->getFlash('dwg_num');
if ($act_num) $search = $act_num;
else if ($dwg_num) $search = $dwg_num;
else $search = '';
?>
<div class="header search-box search-order-act">
    <a href="javascript:history.back();" class="link-back">Назад</a>
     <label>Акт</label>
    <input type="radio" name="search" value="act_num" <? if (!$dwg_num) echo 'checked="checked"'?> " holder="Введите номер акта"/>
    <label style="margin-left: 30px;">Чертеж</label>
    <input type="radio" name="search" value="dwg_num" <? if ($dwg_num) echo 'checked="checked"'?>" holder="Введите номер чертежа"/>
    
    <form action="/search/order/act" class="search-header" method="get">
        <input type="text" value="<?=$search?>" name="act_num" placeholder="Введите номер акта" autofocus />
        <input type="submit" value="Найти" />
    </form>
</div> 