<?php
/** Theme Assets
 * @package EDigitalX
 */

namespace THEME\Inc;

use THEME\Inc\Traits\Singleton;

class Assets {
    use Singleton;

    protected function __construct() {
        // wp_die( 'Class Assets' );

        //  Cargamos Clases.
        $this -> setup_hooks();
    }

    protected function setup_hooks() {
        /** Actions */
        add_action( 'wp_enqueue_scripts', [ $this, 'register_styles' ] );
        add_action( 'wp_enqueue_scripts', [ $this, 'register_scripts' ] );
        add_action( 'admin_enqueue_scripts', [ $this, 'register_metaboxes_styles' ] );
    }

    public function register_styles() {
        wp_enqueue_style( 'main', THEME_DIR_URI. '/assets/build/css/main.css', [], filemtime( THEME_BUILD_CSS_DIR_PATH .'/main.css' ), 'all' );    //  Normalize se concatea a este archivo
        wp_enqueue_style( 'style', get_stylesheet_uri(), [], filemtime( untrailingslashit( get_stylesheet_directory() ) .'/style.css' ), 'all' );
    }

    public function register_scripts() {
        wp_enqueue_script( 'main', THEME_BUILD_JS_URI . '/main.js', [], filemtime( THEME_BUILD_JS_DIR_PATH .'/main.js' ), true );
    }

    public function register_metaboxes_styles() {
        wp_enqueue_style( 'metabox-style', get_template_directory_uri(). '/assets/build/css/metaboxes.css' );
    }

}