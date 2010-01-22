<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

require '../x/x.php';

function myInitApp($siteDir, array $using) {
    //init xSession
    xSessionStart();

    //ini xAcl
    xAcl(array('*', array())); //blank acl
    xAclAddRole('admin', 0);
    xAclAddRole('user',  1);
    xAclAddRole('guest', 2);
    xAclAddResource('site', 2);

    
    $users = array('username' => 'VARCHAR(50)', 
                   'password' => 'VARCHAR(32)', 
                   'email' => 'VARCHAR(100)',
                   'role' => 'VARCHAR(20)');
    $admin = array('username' => 'admin', 
                   'password' =>  md5('admin'), 
                   'email'    => 'admin@localhost',
                   'role'     => 'admin');
    $user  = array('username' => 'user', 
                   'password' =>  md5('user'), 
                   'email'    => 'user@localhost',
                   'role'     => 'user');
    //init xDb               
    xDbConnect();
    xDbSqliteCreate('users', $users);
    xDbWrite('users', $admin);
    xDbWrite('users', $user);
    
}

$using = array('db', 'acl', 'session', 'user');
xEntryPoint(dirname(__FILE__), 'full.ini', $using);
?>
