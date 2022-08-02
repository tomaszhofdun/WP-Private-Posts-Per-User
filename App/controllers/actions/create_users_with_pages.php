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

    if (empty($_POST['pppu_prefix_username_pagename']) || empty($_POST['pppu_number_of_users']) || empty($_POST['pppu_post_type'])) {
        \error_message(__('You must enter all required information', 'private-posts-per-user'));
        exit;
    }

    $prefix_user_name = $_POST['pppu_prefix_username_pagename'];
    $number_of_users = $_POST['pppu_number_of_users'];

    $users_table = [];
    $individual_pages = [];

    for ($i = 1; $i <= $number_of_users; $i++) {
        $new_user = \pppu_register_new_user($prefix_user_name, $i);

        if (!empty($new_user)) {
            $users_table[] = $new_user;
        }
    }

    if (empty($users_table)) {
        \error_message(__('Looks like none of the users were registered, Please make sure you have provided unique usernames', 'private-posts-per-user'));
        exit;
    }

    include PPPU_PLUGIN_PATH . 'views' . DIRECTORY_SEPARATOR . 'created_users_table.php';

    $post_type = $_POST['pppu_post_type'];

    foreach ($users_table as $user => $value) {
        \pppu_register_new_post($value['name'], $post_type);
    }

    function pppu_register_new_post($name, $post_type): void
    {
        $post_arr = [
            'post_title' => $name,
            'post_content' => '',
            'post_status' => 'publish',
            'post_author' => \get_current_user_id(),
            'post_type' => $post_type,
        ];

        \wp_insert_post($post_arr);
    }

    function pppu_register_new_user($prefix_user_name, $i)
    {
        $user_name = $prefix_user_name . $i;
        $user_id = \username_exists($user_name);

        if (!$user_id) {
            $random_password = \wp_generate_password($length = 12, $include_standard_special_chars = true);
            $user_id = \wp_create_user($user_name, $random_password);

            return [
                'id' => $user_id,
                'name' => $user_name,
                'password' => $random_password,
            ];
        }

        return [];
    }

    function error_message($message): void
    { ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $message; ?>
    </div>
    <?php } ?>
