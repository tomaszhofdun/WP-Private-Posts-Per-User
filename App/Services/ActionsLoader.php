<?php

declare(strict_types=1);

namespace PPPU\Services;

use PPPU\Singleton;

if (!defined('ABSPATH')) {
    exit;
}


class ActionsLoader
{
    use Singleton;

    private function __construct()
    {
        add_action('wp_enqueue_scripts', array($this, 'pppu_main_scripts'));
        add_action('wp_loaded', array($this, 'pppu_no_subs_admin_bar'));
        add_action('plugins_loaded', array($this, 'loadTextDomain'));
        add_action('admin_init', array($this, 'pppu_redirect_subs_to_frontend'));

        // add_action('init', 'cptui_create_custom_post_types', 10); // Leave on standard init for legacy purposes.

        // add_action('activate_' . plugin_basename(__FILE__), 'pppu_add_my_profile_page');

        add_action('init', array($this, 'register_post_types'));
        // add_shortcode( 'bartag', 'bartag_func' );
        // add_action('after_setup_theme', array($this, 'register_primary_menu'));
    }




    // public function pppu_add_my_profile_page()
    // {
    //     $my_post = array(
    //         'post_title'    => 'Mój profil',
    //         'post_content'  => 'profil - działkowiec-page',
    //         'post_status'   => 'publish',
    //         'post_author'   => 1,
    //         'post_type' => 'page'
    //     );

    //     // Insert the post into the database.
    //     wp_insert_post($my_post);
    // }

    // public function register_primary_menu()
    // {
    //     register_nav_menu('pppu_menu', __('PPPU_Menu', PPPU_APP_TEXT_DOMAIN));
    // }

    public function register_post_types()
    {
        // Gardeners Post Type
        register_post_type('gardeners', array(
            'capability_type' => 'gardeners',
            'map_meta_cap' => true,
            // 'show_in_rest' => false,
            // 'show_ui' => true,
            // 'show_in_menu' => true,
            // 'show_in_nav_menus' => true,
            'supports' => array('title'),
            'rewrite' => array('slug' => 'dzialkowcy'),
            'has_archive' => true,
            'public' => true,
            'labels' => array(
                'name' => 'Działkowcy',
                'add_new_item' => 'Dodaj nowego działkowca',
                'edit_item' => 'Edutuj działkowca',
                'all_items' => 'Wszyscy działkowcy',
                'singular_name' => 'Działkowiec'
            ),
            'menu_icon' => 'dashicons-groups'
        ));
    }

    public function pppu_main_scripts()
    {
        // wp_enqueue_script('traffit-form-integrator-style', 'https://cdnjs.cloudflare.com/ajax/libs/axios/0.25.0/axios.min.js');
        wp_enqueue_style('pppu_styles', PPPU_PLUGIN_URL . 'assets/styles/styles.css');
    }

    public function pppu_no_subs_admin_bar()
    {
        $ourCurrentUser = wp_get_current_user();

        if (count($ourCurrentUser->roles) == 1 and $ourCurrentUser->roles[0] == 'subscriber') {
            show_admin_bar(false);
        }
    }

    function pppu_redirect_subs_to_frontend()
    {
        $ourCurrentUser = wp_get_current_user();

        if (count($ourCurrentUser->roles) == 1 and $ourCurrentUser->roles[0] == 'subscriber') {
            wp_redirect(site_url('/'));
            exit;
        }
    }

    public function loadTextDomain()
    {
        load_plugin_textdomain('pppu', false);
    }
}
