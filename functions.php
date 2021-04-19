<?php

if (!defined('ABSPATH')) {
    die('Invalid request.');
}

/* --------------------------------------------------------------
    ENQUEUE AND REGISTER CSS
-------------------------------------------------------------- */

require_once('includes/wp_enqueue_styles.php');

/* --------------------------------------------------------------
    ENQUEUE AND REGISTER JS
-------------------------------------------------------------- */

if (!is_admin()) add_action('wp_enqueue_scripts', 'rctv_enqueue_jquery');
function rctv_enqueue_jquery()
{
    wp_deregister_script('jquery');
    wp_deregister_script('jquery-migrate');
    if ($_SERVER['REMOTE_ADDR'] == '::1') {
        wp_register_script('jquery', get_template_directory_uri() . '/js/jquery.min.js', false, '3.6.0', false);
        wp_register_script('jquery-migrate', get_template_directory_uri() . '/js/jquery-migrate.min.js',  array('jquery'), '3.3.2', false);
    } else {
        wp_register_script('jquery', 'https://code.jquery.com/jquery-3.6.0.min.js', false, '3.6.0', false);
        wp_register_script('jquery-migrate', 'https://code.jquery.com/jquery-migrate-3.3.2.min.js', array('jquery'), '3.3.2', true);
    }
    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery-migrate');
}

/* NOW ALL THE JS FILES */

require_once('includes/wp_enqueue_scripts.php');

/* --------------------------------------------------------------
    ADD CUSTOM WALKER BOOTSTRAP
-------------------------------------------------------------- */

add_action('after_setup_theme', 'rctv_register_navwalker');
function rctv_register_navwalker()
{
    require_once('includes/class-wp-bootstrap-navwalker.php');
}

/* --------------------------------------------------------------
    ADD CUSTOM WORDPRESS FUNCTIONS
-------------------------------------------------------------- */

require_once('includes/wp_custom_functions.php');

/* --------------------------------------------------------------
    ADD REQUIRED WORDPRESS PLUGINS
-------------------------------------------------------------- */

require_once('includes/class-tgm-plugin-activation.php');
require_once('includes/class-required-plugins.php');

/* --------------------------------------------------------------
    ADD CUSTOM WOOCOMMERCE OVERRIDES
-------------------------------------------------------------- */

if (class_exists('WooCommerce')) {
    require_once('includes/wp_woocommerce_functions.php');
}

/* --------------------------------------------------------------
    ADD JETPACK COMPATIBILITY
-------------------------------------------------------------- */

if (defined('JETPACK__VERSION')) {
    require_once('includes/wp_jetpack_functions.php');
}

/* --------------------------------------------------------------
    ADD NAV MENUS LOCATIONS
-------------------------------------------------------------- */

register_nav_menus(array(
    'header_menu' => __('Menu Header', 'rctv'),
    'footer_menu' => __('Menu Footer', 'rctv'),
));

/* --------------------------------------------------------------
    ADD DYNAMIC SIDEBAR SUPPORT
-------------------------------------------------------------- */

add_action('widgets_init', 'rctv_widgets_init');

function rctv_widgets_init()
{
    register_sidebar(array(
        'name' => __('Sidebar Principal', 'rctv'),
        'id' => 'main_sidebar',
        'description' => __('Estos widgets seran vistos en las entradas y páginas del sitio', 'rctv'),
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget'  => '</li>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>',
    ));

    register_sidebars(3, array(
        'name'          => __('Pie de Página %d', 'rctv'),
        'id'            => 'sidebar_footer',
        'description'   => __('Estos widgets seran vistos en el pie de página del sitio', 'rctv'),
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget'  => '</li>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>'
    ));

    if (class_exists('WooCommerce')) {
        register_sidebar(array(
            'name' => __('Sidebar de la Tienda', 'rctv'),
            'id' => 'shop_sidebar',
            'description' => __('Estos widgets seran vistos en Tienda y Categorias de Producto', 'rctv'),
            'before_widget' => '<li id="%1$s" class="widget %2$s">',
            'after_widget'  => '</li>',
            'before_title'  => '<h2 class="widgettitle">',
            'after_title'   => '</h2>',
        ));
    }
}

/* --------------------------------------------------------------
    ADD CUSTOM METABOX
-------------------------------------------------------------- */

require_once('includes/wp_custom_metabox.php');

/* --------------------------------------------------------------
    ADD CUSTOM POST TYPE
-------------------------------------------------------------- */

require_once('includes/wp_custom_post_type.php');

/* --------------------------------------------------------------
    ADD CUSTOM THEME CONTROLS
-------------------------------------------------------------- */

require_once('includes/wp_custom_theme_control.php');

/* --------------------------------------------------------------
    ADD CUSTOM IMAGE SIZE
-------------------------------------------------------------- */
if (function_exists('add_theme_support')) {
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(9999, 400, true);
}
if (function_exists('add_image_size')) {
    add_image_size('avatar', 100, 100, true);
    add_image_size('logo', 170, 130, false);
    add_image_size('blog_img', 276, 217, true);
    add_image_size('single_img', 636, 297, true);
}

/* --------------------------------------------------------------
    SOCIAL NETWORK SHORTCODE
-------------------------------------------------------------- */

add_shortcode('rctv_social_networks', 'rctv_social_networks_callback');
function rctv_social_networks_callback()
{
    ob_start();
?>
    <?php $social_settings = get_option('rctv_social_settings'); ?>
    <div class="social-widget-container">
        <?php if ($social_settings['instagram'] != '') { ?>
            <a href="<?php echo $social_settings['instagram']; ?>" title="<?php _e('Visita nuestro perfil en Instagram', 'yam'); ?>" target="_blank"><i class="fa fa-instagram"></i></a>
        <?php } ?>
        <?php if ($social_settings['facebook'] != '') { ?>
            <a href="<?php echo $social_settings['facebook']; ?>" title="<?php _e('Visita nuestro perfil en Facebook', 'yam'); ?>" target="_blank"><i class="fa fa-facebook-official"></i></a>
        <?php } ?>
        <?php if ($social_settings['twitter'] != '') { ?>
            <a href="<?php echo $social_settings['twitter']; ?>" title="<?php _e('Visita nuestro perfil en Twitter', 'yam'); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
        <?php } ?>
        <?php if ($social_settings['linkedin'] != '') { ?>
            <a href="<?php echo $social_settings['linkedin']; ?>" title="<?php _e('Visita nuestro perfil en LinkedIn', 'yam'); ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
        <?php } ?>
        <?php if ($social_settings['youtube'] != '') { ?>
            <a href="<?php echo $social_settings['youtube']; ?>" title="<?php _e('Visita nuestro perfil en Instagram', 'yam'); ?>" target="_blank"><i class="fa fa-youtube-play"></i></a>
        <?php } ?>
    </div>
    <?php
    $content = ob_get_clean();
    return $content;
}