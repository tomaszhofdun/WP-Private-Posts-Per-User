<?php

declare(strict_types=1); ?>

  <div class="alert alert-success" role="alert">
    <ul>
      <li>login: <?php echo get_userdata($user_id)->user_login ?></li>
      <li>new password: <?php echo $password ?></li>
    </ul>
    <h2><?php _e('Password succesfully changed', 'private-posts-per-user') ?></h2>
  </div>

<?php
exit;

