<?php
use mihaildev\ckeditor\CKEditor;
use yii\web\JqueryAsset;

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