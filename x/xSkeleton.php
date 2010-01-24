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
    xSkeletonInitTpl();   
	$vDefDir = 'v'. DIRECTORY_SEPARATOR . 'default';
    xSkeletonMkDir(xSkeletonAppName, false);
        xSkeletonWrite(xSkeletonTplGet('ini'),  xSkeletonAppName . '.ini');
        xSkeletonWrite(xSkeletonTplGet('index'),  'index.php');
        xSkeletonWrite(xSkeletonTplGet('init'),  'init.php');
    xSkeletonMkDir('m');
    xSkeletonMkDir('v');
        xSkeletonWrite(xSkeletonTplGet('master'),  'v', 'master.php');
        xSkeletonWrite(xSkeletonTplGet('master'),  'v', 'error.php');
        xSkeletonMkDir($vDefDir);
            xSkeletonWrite(xSkeletonTplGet('vDefault'),  $vDefDir, 'v.php');
    xSkeletonMkDir('c');
        xSkeletonWrite(xSkeletonTplGet('cDefault'), 'c', 'cDefault.php');
        xSkeletonWrite(xSkeletonTplGet('cMaster'), 'c', 'cMaster.php');
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
    if($fe = file_exists($path)) {
        xSkeletonOutOp($fe, 'MkDir', $path);
    } else {
        xSkeletonOutOp(@mkdir($path), 'MkDir', $path);
    }
}

function xSkeletonWrite($data, $to, $toFile = false) {
    $path = $toFile ? xSkeletonPath(true, $to, $toFile) : xSkeletonPath(true, $to);
    xSkeletonOutOp(file_put_contents($path, $data), 'Write', $path);
}

function xSkeletonInitTpl() {
    xSkeletonTplNew('ini', array(xSkeletonAppName, xSkeletonWebRoot, xSkeletonAppName, 
                                 xSkeletonAppName, xSkeletonPath(true, 'assets')));
    xSkeletonTplNew('init', array(xSkeletonAppName));
    xSkeletonTplNew('index', array(xSkeletonAppName));
    xSkeletonTplNew('cMaster');
    xSkeletonTplNew('master');
    xSkeletonTplNew('cDefault');
    xSkeletonTplNew('vDefault');
}

function xSkeletonTplGet($name) {
    return constant('xSkeletonTpl_' . $name);
}

function xSkeletonTplNew($name, $vars = false) {
    $data = file_get_contents(xSkeletonPath(false, 'x', 'xSkeleton', $name));
    define('xSkeletonTpl_' . $name, $vars ? vsprintf($data, $vars) : $data);
}
?>