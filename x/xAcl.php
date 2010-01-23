<?php
function xAcl($new = null, $get = null) {
    static $acl;
    if($new) {
        list($type, $entry) = $new;
        if($type == '*') {
            $acl = $entry;
        } else {
            $acl[$type][$entry['name']] = $entry;
        }
    } else if($get) {
        list($type, $name) = $get;
        return ($name == '*') ? $acl[$type] : $acl[$type][$name];
    } else {
        return $acl;
    }
}
function xAclInit() {
    //blank acl
    xAcl(array('*', array())); 
}
function xAclAddRole($name, $level) {
    xAcl(array('role', array('name' => $name, 'level' => $level)));
}
function xAclGetRole($name) {
    return xAcl(false, array('role', $name));
}
function xAclAddResource($name, $level) {
    xAcl(array('resource', array('name' => $name, 'level' => $level)));
}
function xAclGetResource($name) {
    return xAcl(false, array('resource', $name));
}
function xAclRoleAllowed($role, $resource) {
    $role = xAclGetRole($role);
    $resource = xAclGetResource($resource);
    
    return $role['level'] < $resource['level'];
}
?>
