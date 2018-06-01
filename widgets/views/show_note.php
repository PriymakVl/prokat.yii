<? if ($cutnote): ?>
<a href="#" onclick="alert('<?=$fullnote?>'); return false" id="short-note"><?=$cutnote?></a>
<? else: ?>
    <span id="full-note"><?=$fullnote?></span>
<? endif; ?>


