<?php
function xMail($to, $subject, $message, array $headers = array(), $params = null) {
    if(is_array($to)) {
        $to = implode(',', $this->to);
    }
    
    $header = '';
    foreach ($headers as $key => $value){
        $header .= "$key: $value\r\n";
    }
        
    return mail($to, $subject, $message, $headers, $params);
}
function xMailHtml($to, $subject, $message, array $headers = array()) {
    $headers += array('X-Mailer' => 'PHP', 'MIME-Version' => '1.0', 
                     'Content-type' => ' text/html; charset=iso-8859-1');
    return xMail($to, $subject, $message, $headers);
}

function xMailTemplate($to, $subject, $tpl, array $vars = array(), $asHtml = true, $headers = array()) {
    $message = $tpl; //temp
    $message = str_replace(array_keys($vars), array_values($vars), $message);
    return xMailHtml($to, $subject, $message, $headers);
}
?>
