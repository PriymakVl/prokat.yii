<?php
    use app\modules\order\logic\OrderLogic;
    use app\modules\order\models\Order;
    use yii\web\View;
    
    $this->registerCssFile('/css/order.css');
    $this->registerJsFile('/js/order/order/filters_orders.js');

    $session = \Yii::$app->session;
    $hidden = $session->get('order-filters') ? '' : 'hidden';

    echo "<div class='".$hidden."'>";

    //filters one line
    echo View::render('one_line.php', ['params' => $params]);

    //filters two line
    //echo View::renderFile('@app/modules/order/widgets/views/filters_two_line.php', ['params' => $params]);
    echo View::render('two_line.php', ['params' => $params]);
    //filters three line
    //echo View::renderFile('@app/modules/order/widgets/views/filters_three_line.php', ['sections' => $sections, 'params' => $params]);
    echo View::render('three_line.php', compact('sections', 'params'));
    //filters four line
    //echo View::renderFile('@app/modules/order/widgets/views/filters_four_line.php', ['groups' => $groups, 'params' => $params]);
    echo View::render('four_line.php', compact('groups', 'params'));
    echo "</div>";


