<?php
function mUsers() {
    return 'users';
}
function mUsersGet($username) {
    if($username == '*') {
         return xDbRead('*', 'users');
    } else {
        return xDbRead('*', 'users', array('username' => $username));
    }
}
?>
