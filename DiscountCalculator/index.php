<?php

include_once "Core/Order.php";

$order = new Order(['A', 'B', 'B', 'D', 'K', 'K', 'D', 'D', 'A']);
$order->displayOrderInfo();