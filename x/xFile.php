<?php
function xFileInit($siteDir) {
    define('xFileSite', $siteDir);
}

function xFilePath() {
    $imp = func_get_args();
    return implode(DIRECTORY_SEPARATOR, $imp);
}

function xFileController(array $xReq) {
    $c = ucfirst($xReq[0]);
    return xFilePath(xFileSite, 'c', "c$c.php");
}

function xFileModel(array $xReq) {
    $c = ucfirst($xReq[0]);
    return xFilePath(xFileSite, 'm', "m$c.php");
}

function xFileLayoutView($type = 'master') {
    return ($L = xConfigGet('view', $type.'Layout')) ? xFilePath(xFileSite, 'v', "$L.php") : false;
}

function xFileLayoutController($type = 'master') {
    return ($L = xConfigGet('view', $type.'Layout')) ? xFilePath(xFileSite, 'c', "c$L.php") : false;
}


function xFileView(array $xReq) {
    list($controller, $action) = $xReq;
    return xFilePath(xFileSite, 'v', strtolower($controller), "v$action.php");
}
?>
