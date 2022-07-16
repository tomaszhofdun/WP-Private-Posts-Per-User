<?php

declare(strict_types=1);

namespace PPPU\Services;

use PPPU\Singleton;

if (!defined('ABSPATH')) {
    exit;
}


class FilterLoader
{
    use Singleton;

    private function __construct()
    {
        add_filter('template_include', array($this, 'pppu_redirectToUserPage'), 1);
        add_filter('template_include', array($this, 'pppu_check_privileges'), 2);
        add_filter('template_include', array($this, 'hideUserButton'), 3);
    }

    /**** Redirect to 'dzialkowcy/user-slug ****/
    public function pppu_redirectToUserPage($template)
    {
        if (is_post_type_archive('gardeners') && is_user_logged_in()) {
            $current_user = wp_get_current_user();
            $small_case = strtolower($current_user->nickname);
            $profile_slug = str_replace(' ', '-', $small_case);
            wp_safe_redirect(site_url() . '/dzialkowcy' . '/' . $profile_slug);
        } elseif (is_post_type_archive('gardeners')) {
            wp_safe_redirect(site_url());
        }

        return  $template;
    }


    public function pppu_check_privileges($template)
    {
        /**** On specific single cpt render  ****/
        if (is_singular('gardeners')) {
            wp_enqueue_script('gardenersjs', PPPU_PLUGIN_URL . '/assets/scripts/pppu.js', array('jquery'), microtime(), true);
            wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css', array(), microtime());

            /**** Add some id's manually if you want from php code ****/
            $manual_set_users_ids = [];

            $set_users_ids = get_field('users') ?: [];
            $current_user_id = get_current_user_id();
            $merged_allowed_users = array_merge($set_users_ids, $manual_set_users_ids);

            /**** Redirect if user is not allowed or not administrator ****/
            if (in_array($current_user_id, $merged_allowed_users) || current_user_can('administrator')) :
                return PPPU_PLUGIN_PATH . 'views/template-gardeners.php'; else :
                    return PPPU_PLUGIN_PATH . 'views/template-gardeners-404.php';
                endif;
        }
        return $template;
    }

    public function hideUserButton($template)
    {
        if (!is_user_logged_in()) { ?>
            <style>
                .navbar-nav>li:last-child a {
                    display: none;
                }
            </style>


<?php }
        return $template;
    }
}
