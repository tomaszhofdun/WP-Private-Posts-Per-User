<?php declare(strict_types=1);
?>

<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body class="pppu_body">
    <div class="container">
        <div class="row w-100 d-flex justify-content-center align-items-center main_div">
            <div class="col-12">
                <div class="pppu_reset_body py-3 px-2">
                    <h2 class="text-center my-3 text-capitalize" style="color:black; margin-left:15px; font-size:35px;"> <span><?php _e('Change Password Form', 'private-posts-per-user'); ?></span> </h2>
                    <div class="row mx-auto">
                        <div class=" col-12  mx-auto">
                            <form class="pppu_my_form" action="<?= $change_users_password_url; ?>" method="POST" >
                                <div class="mb-3">
                                    <?php
                                    $users = get_users( array( 'role__in' => array( 'subscriber' ) ) );
                                    ?>
                                    <select name="pppu_id" id="pppu_id">
                                        <?php foreach ($users as $user) { ?>
                                            <option value="<?= \esc_attr($user->ID); ?>"><?= \esc_html($user->display_name); ?></option>
                                        <?php
                                        } ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <input name="pppu_password" id="pppu_password" type="text" placeholder="<?php _e('New password', 'private-posts-per-user'); ?>">
                                </div>
                                <div class="my-3">
                                    <?php echo "<button class='btn btn-lg btn-success btn-md' onClick=\"javascript: return confirm('Please confirm you want to change the user password')\">
                                        <small style='display: flex; align-items: center;'>
                                        <i class='far fa-save pr-2' style='font-size: 28px'></i>
                                        " . __('Save Settings', 'private-posts-per-user') . "
                                        </small>
                                        </button>"; ?>
                                </div>
                                <input type="hidden" name="NONCE" value="<?= \wp_create_nonce('pppu-plugin-nonce'); ?>">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
