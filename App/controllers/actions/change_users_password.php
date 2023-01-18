<?php
    declare(strict_types=1);

    if (!isset($_POST['NONCE'])) {
        \error_message(__('You are not allowed to access this page', 'private-posts-per-user'));
        exit;
    }

    $nonce = \sanitize_text_field($_POST['NONCE']);

    if (!\wp_verify_nonce($nonce, 'pppu-plugin-nonce')) {
        \error_message(__('You are not allowed to access this page', 'private-posts-per-user'));
        exit;
    }

    if (empty($_POST['pppu_id']) || empty($_POST['pppu_password'])) {
        \error_message(__('You must enter all required information', 'private-posts-per-user'));
        exit;
    }

    $user_id = $_POST['pppu_id'];
    $password = $_POST['pppu_password'];
    $user = get_userdata($user_id);

    if(!$user) {
        \error_message(__('No such user', 'private-posts-per-user'));
        exit;
    }


    wp_set_password( $password, $user_id );

    if (\is_wp_error(wp_authenticate_username_password(NULL, get_userdata($user_id)->user_login, $password))) {
        \error_message(__('Unknown error. Password has not been change', 'private-posts-per-user'));
        exit;
    }

    include PPPU_PLUGIN_PATH . 'views' . DIRECTORY_SEPARATOR . 'password_changed.php';

    function error_message($message): void
    { ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $message; ?>
    </div>
    <?php } ?>
