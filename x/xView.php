<?php
function xViewDisplay(array $xReq, $viewOpts) {
    if($viewOpts['viewAs'] != 'none') {
        $viewOpts['viewAs']($xReq, $viewOpts);
    }
}
function xViewDefaults() {
    return array('viewAs' => 'xViewAsTemplate');
}

function xViewAsTemplate(array $xReq, $viewOpts) {
    $lvFile = xFileLayoutView();
        
    $content = xViewTemplateSection(xFileView($xReq), '', $viewOpts['vars']);

    if($lvFile) {
        $clFile = xFileLayoutController();
        if($clFile && file_exists($clFile)) {
            include_once $clFile;
            $f = 'c' . xConfigGet('view', 'masterLayout');
            $f($xReq, $viewOpts['vars']);
        }
        $content = xViewTemplateSection($lvFile, $content, $viewOpts['vars']);
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
