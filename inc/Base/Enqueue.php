<?php
/**
 * @package MerchiPlugin
 */

namespace Inc\Base;

use \Inc\Base\BaseController;

class Enqueue extends BaseController
{
    public function register() {
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue') );
        add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue') );
    }
    
    public function enqueue() {
        //enqueue all scripts
        wp_enqueue_style( 'styles',  $this->plugin_url . 'assets/merchi_styles.css' );
        wp_enqueue_script( 'scripts',  $this->plugin_url . 'assets/scripts.js' );
    }

    public function admin_enqueue() {
        $merchi_plugin_object = array(
            'merchiStoreName' => get_option('merchi_url')
        );

        wp_enqueue_script('merchi_plugin_val',  $this->plugin_url . 'assets/scripts.js' );
        wp_localize_script('merchi_plugin_val', 'merchiObject', $merchi_plugin_object);
        wp_enqueue_script( 'ajax_script',  $this->plugin_url . 'assets/create_merchi_products.js', array('jquery') );
        wp_localize_script( 'ajax_script', 'create_merchi_products', array( 'ajax_url' => admin_url('admin-ajax.php'), 'check_nonce' => wp_create_nonce('merchi-nonce') ) );
    }
}
