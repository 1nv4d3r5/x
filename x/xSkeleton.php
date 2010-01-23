<?php
function xSkeletionOutOverview($type, $root, $appdir, $appname, $webroot) {
	echo "Creating $type Application...\n";
    echo "> Root: $root\n";
    echo "> Application Dir: $appdir\n";
    echo "> Application Name: $appname\n";
    echo "> Web Root: $webroot\n\n";
}

function xSkeletonOutOp($test, $operation, $data) {
   if($test) {
        echo "\t($operation Success)\t$data\n";
    } else {
        echo "\t($operation Failed)\t$data\n";
    }
}

function xSkeleton($webRoot, $root = 'Here', $appName = 'basic', $type = 'basic') {
    define('xSkeletonRoot', $root == 'Here' ? dirname(dirname(__FILE__)) : $root);
    define('xSkeletonAppName', $appName);
    define('xSkeletonWebRoot', "$webRoot/$appName/index.php");
    
    xSkeletionOutOverview($type, xSkeletonRoot, 
                          xSkeletonRoot . DIRECTORY_SEPARATOR . xSkeletonAppName, 
                          xSkeletonAppName, xSkeletonWebRoot);
                          
    $type = "xSkeleton$type";
    $type();
}

function xSkeletonBasic() {
    require 'xSkeleton.archive';
	$vDefDir = 'v'. DIRECTORY_SEPARATOR . 'default';
    xSkeletonMkDir(xSkeletonAppName, false);
        xSkeletonWrite(xSkeletonTpl_ini,  xSkeletonAppName . '.ini');
        xSkeletonWrite(xSkeletonTpl_index,  'index.php');
        xSkeletonWrite(xSkeletonTpl_init,  'init.php');
    xSkeletonMkDir('m');
    xSkeletonMkDir('v');
        xSkeletonWrite(xSkeletonTpl_master,  'v', 'master.php');
        xSkeletonWrite(xSkeletonTpl_master,  'v', 'error.php');
        xSkeletonMkDir($vDefDir);
            xSkeletonWrite(xSkeletonTpl_vDef,  $vDefDir, 'v.php');
    xSkeletonMkDir('c');
        xSkeletonWrite(xSkeletonTpl_cDef, 'c', 'cDefault.php');
        xSkeletonWrite(xSkeletonTpl_cMaster, 'c', 'cMaster.php');
    xSkeletonMkDir('assets');
}


function xSkeletonPath($inApp) {
    $imp = func_get_args();
    array_shift($imp);
    if($inApp) {
        array_unshift($imp, xSkeletonAppName);
    }
    array_unshift($imp, xSkeletonRoot);
    return implode(DIRECTORY_SEPARATOR, $imp);
}

function xSkeletonMkDir($dir, $inApp = true){
    $path = xSkeletonPath($inApp, $dir);
    xSkeletonOutOp(@mkdir($path), 'MkDir', $path);
}

function xSkeletonWrite($data, $to, $toFile = false) {
    $path = $toFile ? xSkeletonPath(true, $to, $toFile) : xSkeletonPath(true, $to);
    xSkeletonOutOp(file_put_contents($path, $data), 'Write', $path);
}

?>