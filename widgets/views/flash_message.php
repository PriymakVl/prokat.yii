<? foreach ($messages as $message): ?>
    <?php if (Yii::$app->session->hasFlash($message)): ?>
      <div class="alert alert-<?=$message?> margin-top-15 message-wrp">
          <?=Yii::$app->session->getFlash($message)?>
          <span class="glyphicon glyphicon-remove" title="Закрыть"></span>
      </div>
    <?php endif; ?>
<? endforeach; ?>