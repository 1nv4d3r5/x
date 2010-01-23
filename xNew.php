<?php require 'x/xSkeleton.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>xNew</title>
<style>
form div {
	padding:0.5em;
}

input[type="text"], input[type="password", select] {
	margin-left:2em;
	width:200px;
	height:20px;
	font-size:16px;
}
label {
	width: 8em;
	float: left;
	text-align: right;
	margin-right: 0.5em;
	display: block;
}

a {
	margin-left:3em;
	font-style:normal;
	text-decoration:none;
}
</style>
</head>
<body>
<h1>New x Application</h1>
<?php if(isset($_POST['posted'])): ?>
<pre><?php xSkeleton($_POST['webroot'], $_POST['approot'], $_POST['appname'], $_POST['type']); ?></pre>
<a href="<?php echo $_POST['webroot'] . '/' . $_POST['appname'] . '/index.php'; ?>">Go To <?php echo $_POST['appname'];?>...</a>
<?php else: ?>
    <form id="form1" name="form1" method="post" action="">
     <div id="webroot">
      <label for="webroot">Web Root</label>
      <input type="text" name="webroot" id="username" value="http://localhost:8080"/>
    </div>
    <div id="approot">
      <label for="approot">Application Root</label>
      <input type="text" name="approot" id="password" value="Here"/>
    </div>
    <div id="appname">
      <label for="appname">Application Name</label>
      <input type="text" name="appname" id="password" value="myApp" />
    </div>
    <div id="type">
      <label for="type">type</label>
        <select name="type">
            <option value="basic">basic</option>
        </select>
    </div>
<div style="margin-left:8em;">
	<input name="posted" type="submit" value="Create"  />
</div>
<?php endif;?>
</body>
</html>

