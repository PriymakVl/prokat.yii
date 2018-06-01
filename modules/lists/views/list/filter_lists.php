<?php

?>

<div class="top-menu margin-top-15">
    <label>Группа списков:</label>
    <select id="list-sort-menu">
        <option value="">Все</option>
        <? foreach ($groups as $group): ?>
            <option value="<?=$group->alias?>" <? if ($group->alias == $params['type']) echo 'selected'; ?>><?=$group->name?></option>
        <? endforeach; ?>
    </select>
</div>
