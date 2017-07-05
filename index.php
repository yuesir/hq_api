<?php
header("Content-Type:text/html;charset=UTF-8");

require_once 'util.php';

$apiKey = '1304200';
$secret = 'zOQxgqRuWsb';

$lkid       = 0;
$currency   = 'USD';
$page       = 1;

$startDate  = '2017-06-01';
$endDate    = '2017-06-30';

//request parameters of product API
$productParams = [
    'api_key'   => $apiKey,
    'time'      => time(),
    'lkid'      => $lkid,
    'currency'  => $currency,
    'page'      => $page
];

//request parameters of order API
$orderParams = [
    'api_key'    => $apiKey,
    'time'       => time(),
    'start_date' => $startDate,
    'end_date'   => $endDate,
    'page'       => $page,
];

//create signature
$productSign = createSign($productParams);
$orderSign   = createSign($orderParams);

//get request query string
$productQueryString  = createQueryString($productParams);
$productQueryString .= 'sign='.$productSign;

$orderQueryString  = createQueryString($orderParams);
$orderQueryString .= 'sign='.$orderSign;

//call API
$productApiUrl  = 'https://affiliate.gearbest.com/api/products/list-promotion-products?'.$productQueryString;
$productResult  = file_get_contents($productApiUrl);
$productResult  = json_decode($productResult, true);
print_r($productResult);

echo '=============================================';
$orderApiUrl    = 'https://affiliate.gearbest.com/api/orders/completed-orders?'.$orderQueryString; //沙箱环境调用地址
$orderResult    = file_get_contents($orderApiUrl);
$orderResult    = json_decode($orderResult, true);
print_r($orderResult);