<?php

function xRequestIn() {
    $rf = xConfigGet('application', 'requestFunctions') . 'In';
    return $rf();
}

function xRequestOut() {
    $rf = xConfigGet('application', 'requestFunctions') . 'Out';
    return $rf($xReq);
}

function xRequestDefaultIn() {
    $c = xHttpGet('controller');
    return array($c ? ucfirst($c) : 'Default', xHttpGet('action'));    
}

function xRequestDefaultOut(array $xReq = null) {
    array_unshift($xReq, xConfigGet('application', 'webRoot'));
    return vsprintf('%s?controller=%s&action=%s',$xReq);   
}

function xRedirect(array $to, array $from = array(), $http = true) {
    xHttpRefererSet($from);
    
    if($http) {
        $url = xRequestOut($to);
        header("Location:  $url");
        exit();
    } else {
        xServeRequest($to);
        return array('viewAs' => 'none');
    }
}
?>
