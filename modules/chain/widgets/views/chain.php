<?php

use yii\helpers\Url;

?>

<div  class="sidebar-menu">
    <h5>Цепи</h5>
    <ul >
        <li>
            <a href="<?=Url::to('/chain/iso/list')?>">Цепи ISO</a>
        </li>
        <li>
            <a href="<?=Url::to('/chain/list')?>">Цепи стана</a>
        </li>
    </ul>
</div>