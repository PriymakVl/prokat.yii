<?php
    use yii\web\JqueryAsset;
    $this->registerJsFile('js/application/sort_app.js',  ['depends' => [JqueryAsset::className()]]);
    //debug($params['customer'], false);
    $this->registerCssFile('css/application.css');
?>
<div class="top-menu top-menu-margin">
    <!-- sort year -->
    <label>Год:</label>
    <select id="app-year">
        <option value="all">Все</option>
        <option value="2015" <? if ($params['year'] == '2015') echo 'selected'; ?>>2015</option>
        <option value="2016" <? if ($params['year'] == '2016') echo 'selected'; ?>>2016</option>
        <option value="2017" <? if ($params['year'] == '2017') echo 'selected'; ?>>2017</option>
		<option value="2018" <? if ($params['year'] =='2018') echo 'selected'; ?>>2018</option>
    </select>

    <!-- sort department -->
     <label>Отдел:</label>
    <select id="app-department">
        <option value="all">Все</option>
        <option value="ОМТС" <? if ($params['department'] == 'ОМТС') echo 'selected'; ?>>ОМТС</option>
        <option value="ОО" <? if ($params['department'] == 'ОО') echo 'selected'; ?>>ОО</option>
		<option value="ddd" <? if ($params['department'] == 'ddd') echo 'selected'; ?>>ddd</option>
    </select>
    
    <!-- sort category -->
    <label>Категория:</label>
    <select id="app-category">
        <option value="all">Все</option>
        <? foreach ($categories as $category): ?>
            <option value="<?=$category->alias?>" <? if ($params['category'] == $category->alias) echo 'selected'; ?>><?=$category->name?></option>               
        <? endforeach; ?>
    </select>
</div>
