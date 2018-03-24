<?php
    use app\modules\order\logic\OrderLogic;
    use app\modules\order\models\Order;
    use yii\web\View;
    
    $this->registerCssFile('/css/order.css');
    $this->registerJsFile('/js/order/sort_orders.js');

    $session = \Yii::$app->session;
    $hidden = $session->get('order-filters') ? '' : 'hidden';

    echo "<div class='".$hidden."'>";

    //filters one line
    echo View::renderFile('@app/modules/order/widgets/views/filters_one_line.php');

    //filters two line
    echo View::renderFile('@app/modules/order/widgets/views/filters_two_line.php');

    //filters three line
    echo View::renderFile('@app/modules/order/widgets/views/filters_three_line.php', ['sections' => $sections, 'params' => $params]);

    //filters four line
    echo View::renderFile('@app/modules/order/widgets/views/filters_four_line.php', ['groups' => $groups, 'params' => $params]);

    echo "</div>";

