<?php
use mihaildev\ckeditor\CKEditor;
use yii\web\JqueryAsset;
$work = $order ? $order->work : '';
?>

<div id="order-form-work" style="display: none;">
    <!-- work -->
    <?//=$f->field($form, 'description')->textarea(['rows' => '1', 'value' => $order ? $order->work : ''])->label('Характер работы:')?>
     
     <?
        echo $f->field($form, 'work')->widget(CKEditor::className(),[
                    'editorOptions' => [
                    'preset' => 'standard',   'inline' => false,
                ],
            ])->label('');
    ?> 
    <script>
        document.getElementById("orderform-work").innerHTML = "<?=$work?>";
    </script>
</div>

