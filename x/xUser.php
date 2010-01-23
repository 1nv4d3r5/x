<?php
function xUserInit() {
    define('xUserNS', 'user');
}
function xUserLogin($username, $password, $userDetails) {
    if($userDetails['password'] == $password) {
        unset($userDetails['password']);
        xSessionSetNs(xUserNS, $userDetails);
        return true;
    } else {
        return false;
    }
}
function xUserLogout() {
    xSessionClear(xUserNS);
}
function xUserAllowed($resource) {
    if(xSessionHas(xUserNS, 'role')) {
        return xAclRoleAllowed(xSessionGet(xUserNS, 'role'), $resource);
    } else {
        return false;
    }
}
?>
