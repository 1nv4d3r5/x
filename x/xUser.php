<?php
function xUserLogin($username, $password, $userDetails) {
    if($userDetails['password'] == $password) {
        unset($userDetails['password']);
        xSessionSetNs('user', $userDetails);
        return true;
    } else {
        return false;
    }
}
function xUserLogout() {
    xSessionClear('user');
}
function xUserAllowed($resource) {
    if(xSessionHas('user', 'role')) {
        return xAclRoleAllowed(xSessionGet('user', 'role'), $resource);
    } else {
        return false;
    }
}
?>
