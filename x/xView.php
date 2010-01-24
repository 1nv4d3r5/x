<?php
function xViewDisplay(array $xReq, $action) {
    $vars = array(); $options = xViewDefaults($xReq);
    $action($vars, $options);
    if($options['viewAs'] != 'none') {
        $options['viewAs']($vars, $options);
    }
}

function xViewDefaults(array $xReq) {
    return array('viewAs' => 'xViewAsTemplate', 'xReq' => $xReq);
}

function xViewAsTemplate($vars, $options) {
    $lvFile = xFileLayoutView();
    $content = xViewTemplateSection(xFileView($options['xReq']), '', $vars);

    if($lvFile) {
        $clFile = xFileLayoutController();
        if($clFile && file_exists($clFile)) {
            include_once $clFile;
            $f = 'c' . xConfigGet('view', 'masterLayout');
            $f($vars, $options);
        }
        $content = xViewTemplateSection($lvFile, $content, $vars);
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

function xViewAsRaw($vars, $options) {
    echo print_r(func_get_args(), true);
}

function xViewAsJson($vars, $options) {
    echo json_encode($vars);
}

function xViewAsSerialized($vars, $options) {
    echo serialize($vars);
}

?>
