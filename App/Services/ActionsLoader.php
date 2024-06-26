<?php

declare(strict_types=1);

namespace PPPU\Services;

use PPPU\Singleton;

if (!\defined('ABSPATH')) {
    exit;
}

class ActionsLoader
{
    use Singleton;

    private function __construct()
    {
        $this->includes();
        \add_action('wp_enqueue_scripts', [$this, 'pppu_main_scripts']);
        \add_action('admin_enqueue_scripts', [$this, 'pppu_admin_main_scripts']);
        \add_action('plugins_loaded', [$this, 'loadTextDomain']);
        \add_action('init', [$this, 'register_my_post_type'], 1);
        \add_action('init', [$this, 'register_custom_field'], 2);
        \add_action('admin_menu', [$this, 'pppu_widget_menu']);
    }

    private function includes(): void
    {
        // Include the ACF plugin.
        include_once MY_ACF_PATH . 'acf.php';
        include_once MY_ACFE_PATH . 'acf-extended.php';
    }

    public function pppu_admin_main_scripts(): void
    {

        $page = '';

        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        }

        if ($page == 'pppu_settings' || $page == 'pppu_password_change') {
            \wp_enqueue_style('pppu-fontawesome', 'https://use.fontawesome.com/releases/v5.6.3/css/all.css', null, '5.6.3');
            \wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/css/bootstrap.min.css', null, '4.1.1');
        }
    }

    public function pppu_main_scripts(): void
    {
        \wp_enqueue_style('pppu-fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css', null, '4.4.0');
        \wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@3.3.6/dist/css/bootstrap.min.css', null, '3.3.6');
        \wp_enqueue_style('pppu_styles', PPPU_PLUGIN_APP_URL . 'assets/dist/styles.css', null, '1.0.0');

        \wp_enqueue_script('jQuery2', 'https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js', null, null, true);
        \wp_enqueue_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@3.3.6/dist/js/bootstrap.min.js', ['jQuery2'], '3.3.6', true);
        \wp_enqueue_script('gardenersjs', PPPU_PLUGIN_APP_URL . '/assets/dist/scripts.js', ['bootstrap'], '1.0.0', true);
    }

    public function register_my_post_type(): void
    {
        // Gardeners Post Type
        \register_post_type('gardeners', [
            'capability_type' => 'post',
            'map_meta_cap' => true,
            // 'show_in_rest' => false,
            // 'show_ui' => true,
            // 'show_in_menu' => true,
            // 'show_in_nav_menus' => true,
            'supports' => ['title'],
            'rewrite' => ['slug' => 'dzialkowcy'],
            'has_archive' => true,
            'public' => true,
            'labels' => [
                'name' => 'Działkowcy',
                'add_new_item' => 'Dodaj nowego działkowca',
                'edit_item' => 'Edutuj działkowca',
                'all_items' => 'Wszyscy działkowcy',
                'singular_name' => 'Działkowiec',
            ],
            'menu_icon' => 'dashicons-groups',
        ]);
    }

    public function register_custom_field(): void
    {
        if (\function_exists('acf_add_local_field_group')) {
            \acf_add_local_field_group([
                'key' => 'group_1',
                'title' => __('Tabs', 'private-posts-per-user'),
                'fields' => [
                    [
                        'key' => 'fees',
                        'label' => __('Fees', 'private-posts-per-user'),
                        'name' => __('Fees', 'private-posts-per-user'),
                        'type' => 'wysiwyg',
                        'prefix' => '',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                        'readonly' => 0,
                        'disabled' => 0,
                    ],
                    [
                        'key' => 'messages',
                        'label' => __('Messages', 'private-posts-per-user'),
                        'name' => __('Messages', 'private-posts-per-user'),
                        'type' => 'wysiwyg',
                        'prefix' => '',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                        'readonly' => 0,
                        'disabled' => 0,
                    ],
                ],
                'location' => [
                    [
                        [
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => 'gardeners',
                        ],
                    ],
                ],
                'menu_order' => 0,
                'position' => 'normal',
                'style' => 'default',
                'label_placement' => 'top',
                'instruction_placement' => 'label',
                'hide_on_screen' => '',
            ]);

            \acf_add_local_field_group([
                'key' => 'group_2',
                'title' => __('This page will be only visible for these users', 'private-posts-per-user'),
                'fields' => [
                    [
                        'key' => 'users',
                        'label' => __('User name', 'private-posts-per-user'),
                        'name' => __('User name', 'private-posts-per-user'),
                        'type' => 'user',
                        'prefix' => '',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'role' => ['subscriber'],
                        'multiple' => 1,
                        'return_format' => 'id',
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                        'readonly' => 0,
                        'disabled' => 0,
                    ],
                ],
                'location' => [
                    [
                        [
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => 'gardeners',
                        ],
                    ],
                ],
                'menu_order' => 0,
                'position' => 'side',
                'style' => 'default',
                'label_placement' => 'top',
                'instruction_placement' => 'label',
                'hide_on_screen' => '',
            ]);
        }
    }

    public function loadTextDomain(): void
    {
        \load_plugin_textdomain('private-posts-per-user', false, 'private-posts-per-user/App/lang/');
    }

    public function pppu_widget_menu(): void
    {
        $menu_slug = 'pppu_settings';
        \add_menu_page('Private Posts', __('Private Posts', 'private-posts-per-user'), 'administrator', $menu_slug, [$this, 'pppu_controller'], 'dashicons-lock');
        \add_menu_page('Password Change', __('Password Change', 'private-posts-per-user'), 'administrator', 'pppu_password_change', [$this, 'pppu_controller'], 'dashicons-lock');
    }

    public function pppu_controller(): void
    {
        include PPPU_PLUGIN_PATH . '/controllers' . DIRECTORY_SEPARATOR . 'main_controller.php';
    }
}
