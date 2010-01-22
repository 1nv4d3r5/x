<?php
function cMaster(array $xReq, &$vars) {
    $vars['xReq'] = $xReq;
    $vars['log']  = xSessionHas('user') ? 'Logout' : 'Login';
}
?>
