<?php

declare(strict_types=1);

namespace PPPU\Services;

use PPPU\Singleton;

if (!\defined('ABSPATH')) {
    exit;
}

class FilterLoader
{
    use Singleton;

    private function __construct()
    {
        \add_filter('template_include', [$this, 'pppu_redirectToUserPage'], 1);
        \add_filter('template_include', [$this, 'pppu_check_privileges'], 2);
        \add_filter('acf/settings/show_admin', '__return_false');

    }

    /**
     * Redirect to 'dzialkowcy/user-slug.
     *
     * @param mixed $template
     *
     * @return mixed $template
     */
    public function pppu_redirectToUserPage($template)
    {
        if (!\is_post_type_archive('gardeners')) {
            return $template;
        }

        if (!\is_user_logged_in()) {
            \wp_safe_redirect(\site_url());
            exit;
        }

        $current_user = \wp_get_current_user();
        $small_case = \strtolower($current_user->nickname);
        $profile_slug = \str_replace(' ', '-', $small_case);
        \wp_safe_redirect(\site_url() . '/dzialkowcy' . '/' . $profile_slug);
    }

    /**
     * Check if user is allowed to see the page. Based on the conditions renders different template.
     *
     * @param mixed $template
     *
     * @return mixed $template
     */
    public function pppu_check_privileges($template)
    {
        if (\is_singular('gardeners')) {

            /**  Add some id's manually if you want from php code. */
            $manual_set_users_ids = [];

            $set_users_ids = \get_field('users') ?: [];
            $current_user_id = \get_current_user_id();
            $merged_allowed_users = \array_merge($set_users_ids, $manual_set_users_ids);

            /** Redirect if user is not allowed or not administrator */
            if (\in_array($current_user_id, $merged_allowed_users) || \current_user_can('administrator')) {
                return PPPU_PLUGIN_PATH . 'views/template-gardeners.php';
            }

            return PPPU_PLUGIN_PATH . 'views/template-gardeners-404.php';
        }

        return $template;
    }
}
