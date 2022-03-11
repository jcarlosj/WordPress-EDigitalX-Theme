<?php
/** Register Theme SideBars
 * @package EDigitalX
 */

namespace THEME\Inc;

use THEME\Inc\Traits\Singleton;

class Sidebars {
    use Singleton;

    protected function __construct() {
        // wp_die( 'Class Sidebars' );

        //  Cargamos Clases.
        $this -> setup_hooks();
    }

    protected function setup_hooks() {
        /** Actions */
        add_action( 'widgets_init', [ $this, 'register_sidebars' ] );
    }

    function register_sidebars() {
        /* Register the 'primary' sidebar. */
        register_sidebar(
            array(
                'id'            => 'primary_sidebar_widget',
                'name'          => __( 'Primary Sidebar Widget' ),
                'description'   => __( 'Main site sidebar.' ),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>',
            )
        );
        /* Repeat register_sidebar() code for additional sidebars. */
    }

}