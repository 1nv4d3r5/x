<?php
function xFileInit($siteDir) {
    define('xFileSite', $siteDir);
}

function xFilePath() {
    $imp = func_get_args();
    return implode(DIRECTORY_SEPARATOR, $imp);
}

function xFileController(array $xReq) {
    return xFilePath(xFileSite, 'c', "c$xReq[0].php");
}

function xFileModel(array $xReq) {
    return xFilePath(xFileSite, 'm', "m$xReq[0].php");
}

function xFileViewLayout($type = 'master') {
    return ($L = xConfigGet('view', $type.'Layout')) ? xFilePath(xFileSite, 'v', "$L.php") : false;
}

function xFileView(array $xReq) {
    list($controller, $action) = $xReq;
    return xFilePath(xFileSite, 'v', strtolower($controller), "v$controller$action.php");
}
?>
