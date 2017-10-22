<?php

return [
    'adminEmail' => 'admin@example.com',
    //'detailNames' => require(__DIR__ . '/my_params/detail_names.php'),
    'detailNames' => file('../web/params/detail_names.txt'),
    'orderNumbers' => file('../web/params/order_numbers.txt'),
];
