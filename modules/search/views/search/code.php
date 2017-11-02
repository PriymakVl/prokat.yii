<?php
    use app\modules\search\widgets\SearchObjectBreadcrumbsWidget;
    
    $this->registerCssFile('css/search.css');
?>
<div class="content">
    <h2 class="title-search">Результаты поиска</h2>
    <div class="info-box margin-bottom-15">
        Поиск произведен по коду:<span>&laquo; <?=$code?> &raquo;</span>
        <a href="#" onclick="javascript:history.back();">Вернуться назад</a>
    </div>
<? if ($objects): ?>
    <? $number = 1; ?>
    <? foreach ($objects as $object): ?>
        <?=SearchObjectBreadcrumbsWidget::widget(['object' => $object, 'number' => $number])?>
    <? $number++; ?>
    <? endforeach; ?>
    
<? else: ?>
    <p class="not-result">Поиск не дал результатов</p>
<? endif; ?>
</div>