<?php
function xConfig($new = false, $get = null) {
    static $config; if(empty($config)) $config = array();
    if($new) {
        list($namesapce, $key, $value) = $new;
        if($namesapce == '*') { 
            $config = $value; 
        } elseif($key == '*') {
            $config[$namesapce] = $value;
        } else {
            $config[$namespace][$key] = $value;
        }
    } elseif($get) {
        list($namespace, $key) = $get;
        if($key == '*') {
            return isset($config[$namespace]) ? $config[$namespace] : null;
        } else {
             return isset($config[$namespace][$key]) ? $config[$namespace][$key] : null;
        }
    } else {
        return $config;
    }
}

function xConfigLoad($file) {
    xConfigSet('*', '*', parse_ini_file($file, true));
}

function xConfigGet($namespace, $key = '*') {
    return xConfig(false, array($namespace, $key));
}

function xConfigSet($namespace, $key, $value) {
    xConfig(array($namespace, $key, $value));
}
?>
