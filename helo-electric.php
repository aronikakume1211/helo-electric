<?php

/**
 * Plugin Name: Helo Electric Elementor Addons
 * Description: Elementor custom widgets and addons for Helo Electric.
 * Plugin URI:  https://helo-electric.co/
 * Version:     1.0.0
 * Author:      Mebratu Kumera
 * Author URI:  https://helo-electric.com/
 * Text Domain: helo-addons
 *
 * Elementor tested up to: 3.5.0
 * Elementor Pro tested up to: 3.5.0
 */

if (!defined('ABSPATH')) exit;

define('MEBRIK_PLUGIN_PATH', plugin_dir_path(__FILE__));



add_action('wp_enqueue_scripts', 'test_plugin_scripts', 99);

function test_plugin_scripts()
{
    wp_enqueue_style('index-style', plugins_url('assets/index.css', __FILE__));
    wp_enqueue_style('splidecss', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css', array(), null);
    wp_enqueue_script('testimonail-script', plugins_url('assets/js/news.js', __FILE__), array(), null, true);
    wp_enqueue_script('splidejs', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js', array(), null, true);
    wp_enqueue_script('mixitup', 'https://cdnjs.cloudflare.com/ajax/libs/mixitup/3.3.1/mixitup.min.js', array(), null, true);
}

function helo_widget_categories($elements_manager)
{
    $elements_manager->add_category(
        'helo',
        [
            'title' => esc_html__('Helo', 'helo-addons'),
            'icon' => 'fa fa-plug'
        ]
    );
}

add_action('elementor/elements/categories_registered', 'helo_widget_categories');


/**
 * Register Widgets.
 *
 * Include widget file and register widget class.
 *
 * @since 1.0.0
 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
 * @return void
 */
function register_essential_custom_widgets($widgets_manager)
{
    require_once(__DIR__ . '/widgets/news.php');
    require_once(__DIR__ . '/widgets/videos.php');
    require_once(__DIR__ . '/widgets/products.php');

    $widgets_manager->register(new News());
    $widgets_manager->register(new Videos());
    $widgets_manager->register(new Products_List());
}

add_action('elementor/widgets/register', 'register_essential_custom_widgets');
