<div class="sidebar-menu" id="main-menu">
    <h5>Главное меню</h5>
    <ul>
        <li>
            <a href="<?=Yii::$app->urlManager->createUrl(['/'])?>">Главная</a>
            <span>&nbsp;|</span>
            <a href="<?=Yii::$app->urlManager->createUrl(['object/specification/main'])?>">Участки</a>
            
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
            <a href="/order/list">Заказы</a><span>&nbsp;&#124;</span>
            <a href="/order-list/list">Списки</a><span>&nbsp;&#124;</span>
            <a href="/order/act/list">Акты</a>
        </li>
        <li>
            <a href="/application/list">Заявки</a><span>&nbsp;&#124;</span>
            <a href="/product/category">Товары</a>
        </li>
        <li>
            <a href="<?=Yii::$app->urlManager->createUrl(['object/form'])?>">Создать объект</a>
        </li>
    </ul>
</div>