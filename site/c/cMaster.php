<?php
function cMaster(&$vars, &$options) {
    $vars['xReq'] = $options['xReq'];
    $vars['log']  = xSessionHas('user') ? 'Logout' : 'Login';
}
?>
