<?php
/** Register Theme Menues
 * @package EDigitalX
 */

namespace THEME\Inc;

use THEME\Inc\Traits\Singleton;

class Menues {
    use Singleton;

    protected function __construct() {
        // wp_die( 'Class Menus' );

        //  Cargamos Clases.
        $this -> setup_hooks();
    }

    protected function setup_hooks() {
        /** Actions */
        add_action( 'init', [ $this, 'register_menus'] );
        add_filter( 'nav_menu_link_attributes', [ $this, 'add_class_to_menu_link' ], 10, 3 );
    }

    public function register_menus() {
        register_nav_menus([
            'edigitalx-header-menu' => esc_html__( 'Header Menu', 'edigitalx' ),
            'edigitalx-footer-menu' => esc_html__( 'Footer Menu', 'edigitalx' ),
            'edigitalx-social-footer-menu' => esc_html__( 'Footer Social Menu', 'edigitalx' )
        ]);
    }

    /** Agrega clases a enlaces del menu de redes sociales */
    public function add_class_to_menu_link( $atts, $item, $args ) {
        
        // Verifica que se haga referencia al menu edigitalx-social-footer-menu
        if( $args -> theme_location == 'edigitalx-social-footer-menu' ) {
            $atts[ 'class' ] = 'menu-social__link';         //  Agrega clase al enlace
        }

        return $atts;
    }

}