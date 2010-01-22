<?php if($vars['from']): ?>
<h1><?php echo implode('/', $vars['from']);?> Requires you to log in...</h1>
<?php endif;?>

<form action="" method="post">
<label>Username: <input name="User[username]" type="text"></label>
<label>Password: <input name="User[password]" type="password"></label>
<input type="submit" value="Login">
</form>