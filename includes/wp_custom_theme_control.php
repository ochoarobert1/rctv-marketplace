<?php

if (!defined('ABSPATH')) {
    die('Invalid request.');
}

/* --------------------------------------------------------------
WP CUSTOMIZE SECTION - CUSTOM SETTINGS
-------------------------------------------------------------- */

add_action('customize_register', 'rctv_customize_register');

function rctv_customize_register($wp_customize)
{

    /* SOCIAL SETTINGS */
    $wp_customize->add_section('rctv_social_settings', array(
        'title'    => __('Redes Sociales', 'rctv'),
        'description' => __('Agregue aqui las redes sociales de la página, serán usadas globalmente', 'rctv'),
        'priority' => 175,
    ));

    $wp_customize->add_setting('rctv_social_settings[facebook]', array(
        'default'           => '',
        'sanitize_callback' => 'rctv_sanitize_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
    ));

    $wp_customize->add_control('facebook', array(
        'type' => 'url',
        'section' => 'rctv_social_settings',
        'settings' => 'rctv_social_settings[facebook]',
        'label' => __('Facebook', 'rctv'),
    ));

    $wp_customize->add_setting('rctv_social_settings[twitter]', array(
        'default'           => '',
        'sanitize_callback' => 'rctv_sanitize_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
    ));

    $wp_customize->add_control('twitter', array(
        'type' => 'url',
        'section' => 'rctv_social_settings',
        'settings' => 'rctv_social_settings[twitter]',
        'label' => __('Twitter', 'rctv'),
    ));

    $wp_customize->add_setting('rctv_social_settings[instagram]', array(
        'default'           => '',
        'sanitize_callback' => 'rctv_sanitize_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('instagram', array(
        'type' => 'url',
        'section' => 'rctv_social_settings',
        'settings' => 'rctv_social_settings[instagram]',
        'label' => __('Instagram', 'rctv'),
    ));

    $wp_customize->add_setting('rctv_social_settings[linkedin]', array(
        'default'           => '',
        'sanitize_callback' => 'rctv_sanitize_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
    ));

    $wp_customize->add_control('linkedin', array(
        'type' => 'url',
        'section' => 'rctv_social_settings',
        'settings' => 'rctv_social_settings[linkedin]',
        'label' => __('LinkedIn', 'rctv'),
    ));

    $wp_customize->add_setting('rctv_social_settings[youtube]', array(
        'default'           => '',
        'sanitize_callback' => 'rctv_sanitize_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('youtube', array(
        'type' => 'url',
        'section' => 'rctv_social_settings',
        'settings' => 'rctv_social_settings[youtube]',
        'label' => __('YouTube', 'rctv'),
    ));

    /* COOKIES SETTINGS */
    $wp_customize->add_section('rctv_cookie_settings', array(
        'title'    => __('Cookies', 'rctv'),
        'description' => __('Opciones de Cookies', 'rctv'),
        'priority' => 176,
    ));

    $wp_customize->add_setting('rctv_cookie_settings[cookie_text]', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
        'capability'        => 'edit_theme_options',
        'type'           => 'option'

    ));

    $wp_customize->add_control('cookie_text', array(
        'type' => 'textarea',
        'label'    => __('Cookie consent', 'rctv'),
        'description' => __('Texto del Cookie consent.'),
        'section'  => 'rctv_cookie_settings',
        'settings' => 'rctv_cookie_settings[cookie_text]'
    ));

    $wp_customize->add_setting('rctv_cookie_settings[cookie_link]', array(
        'default'           => '',
        'sanitize_callback' => 'absint',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('cookie_link', array(
        'type'     => 'dropdown-pages',
        'section' => 'rctv_cookie_settings',
        'settings' => 'rctv_cookie_settings[cookie_link]',
        'label' => __('Link de Cookies', 'rctv'),
    ));
}

function rctv_sanitize_url($url)
{
    return esc_url_raw($url);
}

/* --------------------------------------------------------------
CUSTOM CONTROL PANEL
-------------------------------------------------------------- */
/*
function register_rctv_settings() {
    register_setting( 'rctv-settings-group', 'monday_start' );
    register_setting( 'rctv-settings-group', 'monday_end' );
    register_setting( 'rctv-settings-group', 'monday_all' );
}

add_action('admin_menu', 'rctv_custom_panel_control');

function rctv_custom_panel_control() {
    add_menu_page(
        __( 'Panel de Control', 'rctv' ),
        __( 'Panel de Control','rctv' ),
        'manage_options',
        'rctv-control-panel',
        'rctv_control_panel_callback',
        'dashicons-admin-generic',
        120
    );
    add_action( 'admin_init', 'register_rctv_settings' );
}

function rctv_control_panel_callback() {
    ob_start();
?>
<div class="rctv-admin-header-container">
    <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="rctv" />
    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
</div>
<form method="post" action="options.php" class="rctv-admin-content-container">
    <?php settings_fields( 'rctv-settings-group' ); ?>
    <?php do_settings_sections( 'rctv-settings-group' ); ?>
    <div class="rctv-admin-content-item">
        <table class="form-table">
            <tr valign="center">
                <th scope="row"><?php _e('Monday', 'rctv'); ?></th>
                <td>
                    <label for="monday_start">Starting Hour: <input type="time" name="monday_start" value="<?php echo esc_attr( get_option('monday_start') ); ?>"></label>
                    <label for="monday_end">Ending Hour: <input type="time" name="monday_end" value="<?php echo esc_attr( get_option('monday_end') ); ?>"></label>
                    <label for="monday_all">All Day: <input type="checkbox" name="monday_all" value="1" <?php checked( get_option('monday_all'), 1 ); ?>></label>
                </td>
            </tr>
        </table>
    </div>
    <div class="rctv-admin-content-submit">
        <?php submit_button(); ?>
    </div>
</form>
<?php
    $content = ob_get_clean();
    echo $content;
}
*/
