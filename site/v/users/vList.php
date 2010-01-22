<div id="users">
<?php foreach($vars['users'] as $user):?>
      <table width="200" style="border: none; padding-bottom:2em;">
        <tr>
          <td><strong>Username</strong></td>
          <td><?php echo $user['username']; ?></td>
        </tr>
        <tr>
          <td><strong>Email</strong></td>
          <td><?php echo $user['email']; ?></td>
        </tr>
        <tr>
          <td><strong>Role</strong></td>
          <td><?php echo $user['role']; ?></td>
        </tr>
      </table>
<?php endforeach; ?>
</div>

