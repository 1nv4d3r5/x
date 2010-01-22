<?php
function xRequest(array $xReq = null) {
    $rf = xConfigGet('application', 'requestFunction');
    return $rf($xReq);
}

function xRequestDefaultRoute(array $xReq = null) {
    if($xReq) {
        array_unshift($xReq, xConfigGet('application', 'webRoot'));
        return vsprintf('%s?controller=%s&action=%s',$xReq);
    } else {
        $c = xHttpGet('controller');
        return array($c ? ucfirst($c) : 'Default', xHttpGet('action'));
    }
}

function xRedirect(array $to, array $from = array(), $http = true) {
    xHttpRefererSet($from);
    
    if($http) {
        $url = xRequest($to);
        header("Location:  $url");
        exit();
    } else {
        xServeRequest($to);
        return array('viewAs' => 'none');
    }
}
?>
