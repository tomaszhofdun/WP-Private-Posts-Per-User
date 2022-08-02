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
                    <h2 class="text-center my-3 text-capitalize" style="color:black; margin-left:15px; font-size:35px;"> <span><?php _e('Create Users Form', 'private-posts-per-user'); ?></span> </h2>
                    <div class="row mx-auto">
                        <div class=" col-12  mx-auto">
                            <form class="pppu_my_form" action="<?= $create_users_with_pages_url; ?>" method="POST" >
                                <input name="pppu_prefix_username_pagename-checkbox" id="pppu_prefix_username_pagename-checkbox" type="checkbox" ><label for="pppu_prefix_username_pagename-checkbox" ><?php _e('Use prefix ?', 'private-posts-per-user'); ?></label>
                                <div class="mb-3">
                                    <input name="pppu_prefix_username_pagename" id="pppu_prefix_username_pagename" type="text" placeholder="<?php _e('User name prefix', 'private-posts-per-user'); ?>"><label for="pppu_prefix_username_pagename" style="margin-left:5%;"><?php _e('User name will be followed by the numbers ex. "name" will be replaced with name1, name2, name3 etc.', 'private-posts-per-user'); ?></label>
                                </div>
                                <div class="mb-3">
                                    <input name="pppu_number_of_users" id="pppu_number_of_users" type="number" value=1 placeholder="<?php _e('Number of users', 'private-posts-per-user'); ?>"><label for="pppu_number_of_users" style="margin-left:5%;"><?php _e('How many users will be created', 'private-posts-per-user'); ?></label>
                                </div>
                                <div class="mb-3">
                                    <?php
                                    $args = ['public' => true];
                                    $post_types = \get_post_types($args, 'objects'); ?>
                                    <select name="pppu_post_type" id="pppu_post_type">
                                        <?php foreach ($post_types as $post_type_obj) {
                                            $labels = \get_post_type_labels($post_type_obj); ?>
                                            <option value="<?= \esc_attr($post_type_obj->name); ?>"><?= \esc_html($labels->name); ?></option>
                                        <?php
                                        } ?>
                                    </select>
                                </div>
                                <div class="my-3">
                                    <?php echo "<button class='btn btn-lg btn-success btn-md' onClick=\"javascript: return confirm(_e('Please confirm you want to create a user', 'private-posts-per-user');\">
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