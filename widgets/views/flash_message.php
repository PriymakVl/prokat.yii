<? foreach ($messages as $message): ?>
    <?php if (Yii::$app->session->hasFlash($message)): ?>
      <div class="alert alert-<?=$message?> margin-top-15">
          <?=Yii::$app->session->getFlash($message)?>
      </div>
    <?php endif; ?>
<? endforeach; ?>