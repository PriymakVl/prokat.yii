<?php
    use app\modules\order\logic\OrderLogic;
    use app\modules\order\models\Order;
    use yii\web\View;
    
    $this->registerCssFile('/css/order.css');
    $this->registerJsFile('/js/order/sort_orders.js');

    //filters one line
    echo View::renderFile('@app/modules/order/widgets/views/filters_one_line.php');

    //filters two line
    echo View::renderFile('@app/modules/order/widgets/views/filters_two_line.php');

    //filters two line
    echo View::renderFile('@app/modules/order/widgets/views/filters_three_line.php', ['sections' => $sections, 'equipments' =>$equipments, 'units' => $units,
        'section_id' => $section_id, 'equipment_id' => $equipment_id, 'unit' => $unit_id]);

