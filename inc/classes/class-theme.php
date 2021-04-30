<?php
/** Boostraps the Theme
 * @package EDigitalX
 */

namespace THEME\Inc;

use THEME\Inc\Traits\Singleton;

class Theme {
    use Singleton;

    protected function __construct() {
        // wp_die( "Theme!"  );

        /** Carga clases */
        Assets :: get_instance();
        Hooks :: get_instance();
        Menues :: get_instance();
        MetaBoxes :: get_instance();

        $this -> setup_hooks();
    }

    protected function setup_hooks() {
        /** Actions */
        $this -> setup_theme();
    }

    public function setup_theme() {
        add_action( 'after_setup_theme', [ $this, 'support_settings_for_gutenberg' ] );
        add_action( 'after_setup_theme', [ $this, 'wp_52_backward_compatible' ] );
        add_action( 'wp_enqueue_scripts', [ $this, 'load_dashicons_front_end' ] );
    }

    #   Soporte de hoja de estilos por defecto para Gutenberg
    public function support_settings_for_gutenberg() {
        add_theme_support( 'wp-block-styles' );
    }

    #   Compatible con versiones anteriores (por debajo de WordPress 5.2)
    public function wp_52_backward_compatible() {

        if ( ! function_exists( 'wp_body_open' ) ) {

            /** Shim for wp_body_open, ensuring backward compatibility with versions of WordPress older than 5.2. */
            function wp_body_open() {
                do_action( 'wp_body_open' );
            }
        }
    }

    #   Agregar Dashicons en el Front-end de WordPress
    public function load_dashicons_front_end() {
        wp_enqueue_style( 'dashicons' );
    }
        
}