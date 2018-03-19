<?
use app\modules\orderact\models\OrderAct;
use app\modules\order\models\Order;

?>
<div id="order-act-form-tab-main">

    <div class="top-box">
        <!-- number -->
        <?=$f->field($form, 'number')->textInput(['value' => $act ? $act->number : '', 'maxlength'=>4, 'style' => 'width:100px'])->label('Номер акта:')?>

        <!-- department -->
        <?php
        if ($act) $form->department = $act->department;
        $departments = ['rem' => 'РМЦ', 'ormo' => 'ОРМО', 'instr' => 'Инструментальное отделение', 'smk' => 'Участок металлоконструкций', 'foundry' => 'Литейное отделение', 'hammer' => 'Кузнечное отделение'];
        $params = ['prompt' => 'Не выбран', 'style' => 'width:180px'];
        echo $f->field($form, 'department')->dropDownList($departments, $params)->label('Участок РМЦ:');
        ?>

        <!-- state -->
        <div id="state-wrp">
            <label>Состояние:</label>
            <select id="state"  name="OrderActForm[state]" class="form-control" style="width: 150px;">
                <option value="<?=OrderAct::STATE_PROCESSED?>" <? if ($act->state == OrderAct::STATE_PROCESSED) echo 'selected'; ?>>В оформлении</option>
                <option value="<?=OrderAct::STATE_PASSED?>" <? if ($act->state == OrderAct::STATE_PASSED) echo 'selected'; ?>>Сдан</option>
                <option value="<?=OrderAct::STATE_CANCELED?>" <? if ($act->state == OrderAct::STATE_CANCELED) echo 'selected'; ?>>Отменен</option>
            </select>
        </div>

    </div><!-- /top-box -->

    <div class="act-form-date-wrp">
        <!-- date registration -->
        <?=$f->field($form, 'date_registr')->textInput(['value' => $act->date_registr ? date('d.m.y', $act->date_registr) : date('d.m.y'), 'style' => 'width:120px'])->label('Зарегистр-ван:')?>

        <!-- month -->
        <?php
        $params = ['prompt' => 'Не выбран', 'style' => 'width:150px'];
        $form->month = $act ? $act->month : date('m');
        echo $f->field($form, 'month')->dropDownList($form->months, $params)->label('Месяц:');
        ?>

        <!-- year -->
        <?=$f->field($form, 'year')->textInput(['value' => $act ? $act->year : date('Y'), 'style' => 'width:100px'])->label('Год:')?>
    </div>

    <!-- data -->
    <div class="act-form-data-wrp">
        <!-- cost -->
        <?=$f->field($form, 'cost')->textInput(['value' => $act->cost, 'style' => 'width:150px'])->label('Себестоимость, грн:')?>

        <!-- working hour -->
        <?=$f->field($form, 'working_hour')->textInput(['value' => $act->working_hour, 'style' => 'width:180px'])->label('Нормо часы:')?>

        <!-- type -->
        <?php
            $params = ['prompt' => 'Не выбран', 'style' => 'width:150px'];
            $form->type = $act->type;
            $types = [Order::TYPE_MAKING => 'Изготовление', Order::TYPE_MAINTENANCE => 'Услуга'];
            echo $f->field($form, 'type')->dropDownList($types, $params)->label('Тип:');
        ?>
    </div>

</div><!-- /order-act-form-tab-main -->