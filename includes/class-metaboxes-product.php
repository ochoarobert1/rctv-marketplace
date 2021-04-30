<?php

if (!defined('ABSPATH')) {
    die('Invalid request.');
}
/**
 * CMB2 Custom Metaboxes
 *
 * @link https://woocommerce.com/
 *
 * @package rctv
 */
class customProductCMB2Class extends customCMB2Class
{
    /**
     * Main Constructor.
     */
    public function __construct()
    {
        add_action('cmb2_admin_init', array($this, 'rctv_register_product_metabox'));
    }

    public function rctv_register_product_metabox() {
        $prefix = 'rctv_';

        $cmb_product = new_cmb2_box(array(
            'id'            => $prefix . 'product_image_metabox',
            'title'         => esc_html__('Product Image', 'rctv'),
            'object_types'  => array('product'), // Post type
            'context'    => 'side',
            'priority'   => 'high'
        ));

        $cmb_product->add_field(array(
            'id'        => $prefix . 'product_image_horizontal',
            'name'      => esc_html__('Imagen horizontal del Producto', 'rctv'),
            'desc'      => esc_html__('Cargar un Imagen horizontal o portrait para este Producto', 'rctv'),
            'type'      => 'file',
        
            'options' => array(
                'url' => false
            ),
            'text'    => array(
                'add_upload_file_text' => esc_html__('Cargar Imagen', 'rctv'),
            ),
            'query_args' => array(
                'type' => array(
                    'image/gif',
                    'image/jpeg',
                    'image/png'
                )
            ),
            'preview_size' => 'thumbnail'
        ));
    }
}

new customProductCMB2Class;