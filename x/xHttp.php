<?php
function xHttpGet($key, $filter = false) {
    if(empty($_GET[$key])) { 
        return ''; 
    }
    return $filter ? filter_input(INPUT_GET, $key, $filter) : $_GET[$key];
}

function xHttpPost($key, $filter = false) {
    if(empty($_POST[$key])) { 
        return ''; 
    }
    return $filter ? filter_input(INPUT_POST, $key, $filter) : $_POST[$key];
}

function xHttpIsPost() {
    return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function xHttpReferer() {
    if(defined('xSessionNs')) {
        return xSessionHas(xSessionNs, 'lastRequest') ? xSessionGet(xSessionNs, 'lastRequest') : false;
    }
    
    return false;
}
function xHttpRefererSet(array $xReq) {
    if(defined('xSessionNs')) {
        xSessionSet(xSessionNs, 'lastRequest', $xReq);
    }
}
