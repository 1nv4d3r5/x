<?php if($vars['from']): ?>
<h1><?php echo implode('/', $vars['from']);?> Requires you to log in...</h1>
<?php endif;?>
<form id="form1" name="form1" method="post" action="">
 <div id="username">
  <label for="username">Username</label>
  <input type="text" name="User[username]" id="username" />
</div>
<div id="password">
  <label for="password">Password</label>
  <input type="password" name="User[password]" id="password" />
</div>
 <input type="submit" value="Login" />
</form>
