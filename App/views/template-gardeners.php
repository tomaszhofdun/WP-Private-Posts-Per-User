<?php declare(strict_types=1);
\get_header();

$user = \wp_get_current_user();
$user_firstname = $current_user->user_firstname;
?>

<div class="pppu-tabs">
    <ul class="nav nav-tabs">
        <li role="presentation" class="active"><a href="#home"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php _e('Profile', 'private-posts-per-user') ?></a></li>
        <li role="presentation"><a href="#fees"><span class="glyphicon glyphicon-usd" aria-hidden="true"></span> <?php _e('Fees for electricity', 'private-posts-per-user') ?></a></li>
        <li role="presentation"><a href="#messages"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> <?php _e('Messages', 'private-posts-per-user') ?></a></li>
    </ul>

    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="home">
            <p><?php _e('Hi,', 'private-posts-per-user') ?> <?= $user_firstname; ?></p>
        </div>
        <div role="tabpanel" class="tab-pane bg-danger" id="fees">
            <?php \the_field('fees'); ?>
        </div>
        <div role="tabpanel" class="tab-pane" id="messages">
            <?php \the_field('messages'); ?>
        </div>
    </div>
</div>
<?php \get_footer(); ?>
