<?php
function cUsers() {
    $username = xSessionGet('user', 'username');
    $info = xDbFetch(mUsersGet($username));
    return array('vars' => array('user' => $info));
}

function cUsersAjaxGet() {
    $username = xHttpGet('username');
    $password = xHttpGet('password');
    $error    = array('viewAs' => 'xViewAsJson', 'vars' => array('error' => 'user not found'));
    
    if($username && $password && $user = xDbFetch(mUsersGet($username))) {
        return $user['password'] == md5($password) ? array('viewAs' => 'xViewAsJson', 'vars' => $user)
                                                   : $error;
    } else {
        return $error;
    }
    
}

function cUsersLogin() {
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
        return array('vars' => array('from' => xHttpReferer()));
    }
}

function cUsersLogout() {
    xUserLogout();
}

function cUsersList() {
    if(!xUserAllowed('site')) {
        return xRedirect(array('Users', 'Login'), array('Users', 'List'));
    }
    return array('vars' => array('users' => xDbFetch(mUsersGet('*'), 'assoc', true)));
}
?>
