<div class="sidebar-menu" id="main-menu">
    <h5>Главное меню</h5>
    <ul>
        <li>
            <a href="/">Главная</a><span>&nbsp;&#124;</span>
            <a href="/modules/list" target="_blank">Модули</a>
        </li>
        <li>
            <a href="<?=Yii::$app->urlManager->createUrl(['lists'])?>">Списки</a>
            <span>&nbsp;|</span>
            <a href="<?=Yii::$app->urlManager->createUrl(['list/active'])?>">Активный</a>
        </li>
        <li>
            <a href="<?=Yii::$app->urlManager->createUrl(['drawing/department/list'])?>">Эскизы</a>
                <span>&nbsp;|</span>
            <a href="<?=Yii::$app->urlManager->createUrl(['drawing/works/list'])?>">ПКО</a>
        </li>
        <li>
            <a href="/orders">Заказы</a><span>&nbsp;&#124;</span>
            <a href="/order/act/list">Акты</a>
        </li>
        <li>
            <a href="/application/list">Заявки</a><span>&nbsp;&#124;</span>
            <a href="/product/category">Товары</a>
        </li>

    </ul>
</div>