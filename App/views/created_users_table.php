<?php

declare(strict_types=1); ?>

<table class="table">
<thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col"><?php _e('username','private-posts-per-user') ?></th>
      <th scope="col"><?php _e('password','private-posts-per-user') ?></th>
    </tr>
</thead>
<tbody>
    <?php
foreach ($users_table as $user => $value) { ?>
 <tr>
      <td scope="row"><?= $user; ?></td>
      <td><?= $value['name']; ?></td>
      <td><?= $value['password']; ?></td>
    </tr>
    <?php
} ?>
 </tbody>
</table>

