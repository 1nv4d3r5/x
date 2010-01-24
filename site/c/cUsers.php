<?php
function cUsers(&$vars, &$options) {
    $vars['user'] = xSessionGet('user');
}

function cUsersAdmin(&$vars, &$options) {
    $vars['message'] = 'Hi';
}

function cUsersAjaxGet(&$vars, &$options) {
    $options['viewAs'] = 'xViewAsJson';
    
    $username = xHttpGet('username');
    $password = xHttpGet('password');
    $error    = array('error' => 'user not found');
    
    if($username && $password && $user = xDbFetch(mUsersGet($username))) {
        $vars = $user['password'] == md5($password) ? $user : $error;
    } else {
        $vars = $error;
    }
    
}

function cUsersLogin(&$vars, &$options) {
    if(xHttpIsPost()) {
        $user = xHttpPost('User');
        $fromDb = xDbFetch(mUsersGet($user['username']));
        if(xUserLogin($user['username'], md5($user['password']), $fromDb)) {
            $to = xHttpReferer();
            xRedirect($to ? $to : array('Users', ''));
        } else {
            xErrorX('Failed to log you in!');
        }
    } else {
        $vars['from'] = xHttpReferer();
    }
}

function cUsersLogout(&$vars, &$options) {
    xUserLogout();
}

function cUsersList(&$vars, &$options) {
    if(!xUserAllowed('site')) {
        return xRedirect(array('Users', 'Login'), array('Users', 'List'));
    }
    $vars['users'] = xDbFetch(mUsersGet('*'), 'assoc', true);
}
?>
