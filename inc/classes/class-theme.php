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
        Queries :: get_instance();
        Menues :: get_instance();
        Sidebars :: get_instance();
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
        add_action( 'after_setup_theme', [ $this, 'register_image_support' ] );
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

    #   Agrega soporte a imagen destacada de todas las publicaciones del sitio
    public function register_image_support() {
        //  Agrega soporte imagen destacada en las publicaciones
        add_theme_support( 'post-thumbnails' );

        //  Registra un nuevos tamaños de imagen soportados por el Theme
        add_image_size( 'entry-last-mobile', 356, 235, true );
        add_image_size( 'entry-last', 820, 540, true );
        add_image_size( 'entry-classic-mobile', 356, 190, true );
        add_image_size( 'entry-classic', 400, 267, true );
        add_image_size( 'entry-square-mobile', 220, 220, true );
        add_image_size( 'entry-square', 300, 300, true );
        

        add_theme_support(
			'custom-logo',
			[
				'header-text' => [
					'site-title',
					'site-description',
				],
				'height'      => 68,
				'width'       => 116,
				'flex-height' => true,
				'flex-width'  => true,
			]
		);
    }

    // public function change_custom_logo_classes( $html ) {

    //     $html = str_replace( 'custom-logo', 'your-custom-class', $html );
    //     $html = str_replace( 'custom-logo-link', 'your-custom-class', $html );
    
    //     return $html;
    // }

}