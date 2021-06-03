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
    }

    public function register_menus() {
        register_nav_menus([
            'edigitalx-header-menu' => esc_html__( 'Header Menu', 'edigitalx' ),
        ]);
    }

}