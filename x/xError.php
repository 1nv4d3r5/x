<?php
function xErrorFatal($message) {
    die($message);
}
function xErrorX($message, $code = false) {
    $ef = xConfigGet('application', 'errorFunction');
    $ef($message, $code);
}

function xcError($message, $code) {
    //$code = 1 controller 404, = 2 action 404, =3 view 404
    list($controller, $action) = xRequestIn();
    
    ob_start();
    include_once 'xvError.php';
    $content = ob_get_clean();
    
    if($eL = xFileLayoutView('error')) {
        include_once $eL;
    } else {
        echo $content;
    }
    
    exit();
}
?>
