<?php

/**
 * create signature
 * @param array $paramArr
 * @return string
 */
function createSign ($paramArr) {
    global $secret;
    $sign = $secret;

    ksort($paramArr);
    foreach ($paramArr as $key => $val) {
        if ($key != '' && $val != '') {
            $sign .= $key.$val;
        }
    }

    $sign.= $secret;
    $sign = strtoupper(md5($sign));

    return $sign;
}

/**
 * create query string
 * @param array $paramArr
 * @return string
 */
function createQueryString ($paramArr) {
    $strParam = '';

    foreach ($paramArr as $key => $val) {
        if ($key != '' && $val != '') {
            $strParam .= $key.'='.urlencode($val).'&';
        }
    }

    return $strParam;
}