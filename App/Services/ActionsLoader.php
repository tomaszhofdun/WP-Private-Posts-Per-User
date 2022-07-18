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
        \add_action('plugins_loaded', [$this, 'loadTextDomain']);
        \add_action('init', [$this, 'register_post_types']);
        \add_action('init', [$this, 'register_custom_field']);
    }

    private function includes(): void
    {
        // Include the ACF plugin.
        include_once MY_ACF_PATH . 'acf.php';
        include_once MY_ACFE_PATH . 'acf-extended.php';
    }

    public function pppu_main_scripts(): void
    {
        \wp_enqueue_style('pppu_styles', PPPU_PLUGIN_APP_URL . 'assets/dist/styles.css');
    }

    public function register_post_types(): void
    {
        // Gardeners Post Type
        \register_post_type('gardeners', [
            'capability_type' => 'gardeners',
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
                'title' => 'Zakładki',
                'fields' => [
                    [
                        'key' => 'oplaty',
                        'label' => 'Opłaty',
                        'name' => 'Opłaty',
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
                        'key' => 'wiadomosci',
                        'label' => 'Wiadomości',
                        'name' => 'wiadomosci',
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
                'title' => 'Ta strona będzie widoczna tylko dla tego użytkownika',
                'fields' => [
                    [
                        'key' => 'users',
                        'label' => 'Nazwa użytkownika',
                        'name' => 'Nazwa użytkownika',
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
                'position' => 'normal',
                'style' => 'default',
                'label_placement' => 'top',
                'instruction_placement' => 'label',
                'hide_on_screen' => '',
            ]);
        }
    }

    public function loadTextDomain(): void
    {
        \load_plugin_textdomain('pppu', false);
    }
}
