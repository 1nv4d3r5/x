<?php
function xViewDisplay(array $xReq, $viewOpts) {
    if($viewOpts['viewAs'] != 'none') {
        $viewOpts['viewAs']($xReq, $viewOpts);
    }
}
function xViewDefaults($token) {
    return array('viewAs' => 'xViewAsTemplate', 'token' => $token);
}

function xViewAsTemplate(array $xReq, $viewOpts) {
    $vFile = xFileView($xReq);
    $lFile = xFileViewLayout();
    
    $viewOpts['vars']['xReq'] = $xReq;    
    $content = xViewTemplateSection($vFile, '', $viewOpts['vars']);

    if($lFile) {
        $content = xViewTemplateSection($lFile, $content, $viewOpts['vars']);
    }
    
    echo $content;
}

function xViewTemplateSection($file, $content, &$vars) {
    if(file_exists($file)) {
        ob_start();
        include_once $file;
        return ob_get_clean();
    } else {
        xErrorX("View File ($file) Not Found", 3);
    }
}

function xViewAsRaw(array $xReq, $viewOpts) {
    echo '<pre>', print_r(func_get_args(), true), '</pre>';
}

function xViewAsJson(array $xReq, $viewOpts) {
    echo json_encode($viewOpts['vars']);
}

function xViewAsSerialized(array $xReq, $viewOpts) {
    echo serialize($viewOpts['vars']);
}

?>
