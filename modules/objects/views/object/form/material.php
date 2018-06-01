<?php
use app\modules\objects\widgets\ObjectSelectMaterialWidget;
?>
<div id="form-tab-material" style="display: none">
    <div class="pos-relative">
        <!-- material -->
        <?=$f->field($form, 'material')->textInput(['value' => $obj->material, 'style' => 'width:150px'])->label('Материал:'); ?>

        <!-- select material -->
        <?//=ObjectSelectMaterialWidget::widget(['template' => 'material'])?>

        <!-- analog -->
        <?=$f->field($form, 'analog')->textInput(['value' => $obj->analog, 'style' => 'width:150px'])->label('Аналог материала:'); ?>

        <!-- select analog -->
        <?//=ObjectSelectMaterialWidget::widget(['template' => 'analog'])?>
    </div>
</div>

