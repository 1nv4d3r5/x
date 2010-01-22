<h1>Welcome <?php echo $vars['user']['username']; ?></h1>
<ul>
<?php foreach($vars['user'] as $detail => $value): ?>
<li><?php echo "$detail: $value"; ?></li>
<?php endforeach; ?>
</ul>
