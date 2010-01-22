<?php
require 'xConfig.php';
require 'xError.php';
require 'xFile.php';
require 'xHttp.php';
require 'xRequest.php';
require 'xView.php';

function xEntryPoint($siteDir, $iniFile, array $using = array()) {
    xConfigLoad($siteDir . DIRECTORY_SEPARATOR . $iniFile);
    xFileInit($siteDir);
    
    foreach($using as $u) {
        require 'x' . ucfirst($u) . '.php';
    }
    
    $auxInit = xConfigGet('application', 'initFunction');
    if(function_exists($auxInit)) {
        $auxInit($siteDir, $using);
    }
    
    xServeRequest(xRequest(), xConfigGet('application', 'prefix'));
}

function xServeRequest(array $xReq, $actionPrefix = '') {
    $cFile = xFileController($xReq);
    $mFile = xFileModel($xReq);
    
    if(file_exists($cFile)) {
        if(file_exists($mFile)) {
            include_once $mFile;
        }
        include_once $cFile;
    } else {
        xErrorX("Controller File ($cFile) Not Found", 1);
    }
        
    $function = "{$actionPrefix}c$xReq[0]$xReq[1]";
    
    if(function_exists($function)) {
        xViewDisplay($xReq, (array) $function() +  xViewDefaults($function));
    } else {
        xErrorX("Action ($function) Not Found!", 2);
    }
}
?>