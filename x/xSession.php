<?php
function xSessionStart() {
    define('xSessionNs', '__x__');
    return session_start();
}

function xSessionHas($ns, $key = false) {
    if(isset($_SESSION[$ns])) {
        return $key ? isset($_SESSION[$ns][$key]) : true;
    } else {
        return false;
    }
}
function xSessionSetNs($ns, $value) {
    $_SESSION[$ns] = $value;
}
function xSessionSet($ns, $key, $value) {
    $_SESSION[$ns][$key] = $value;
}

function xSessionGet($ns, $key = false) {
    return $key ? $_SESSION[$ns][$key] : $_SESSION[$ns];
}

function xSessionClear($ns = false) {
    if($ns) {
        session_destroy(); 
    } else { 
        unset($_SESSION[$ns]);
    }
}
?>
