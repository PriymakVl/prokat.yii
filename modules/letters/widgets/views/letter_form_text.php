<?php
use yii\jui\DatePicker;
use mihaildev\ckeditor\CKEditor;
use yii\web\JqueryAsset;

$this->registerJsFile('js/order/form_order_get_equipment.js',  ['depends' => [JqueryAsset::className()]]);
?>

<div id="letter-form-text" style="display:none;">
    <?
        echo $f->field($form, 'text')->widget(CKEditor::className(),[
                    'editorOptions' => [
                    'preset' => 'full',   'inline' => false,
                ],
            ]);
    ?> 
</div><!-- letter data -->