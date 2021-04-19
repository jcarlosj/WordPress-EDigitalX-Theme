<?php
/** Theme Hooks
 * @package EDigitalX
 */

namespace THEME\Inc;

use THEME\Inc\Traits\Singleton;

class Hooks {
    use Singleton;

    protected function __construct() {
        // wp_die( 'Class Hooks' );

        //  Cargamos Clases.
		$this -> setup_hooks();
    }

    protected function setup_hooks() {
        /** Actions */
		add_action( 'get_file_name', [ $this, 'show_file_name' ] );		//	Engancha función a una acción específica
	}
        
    public function show_file_name( $args ) {

        if( isset( $args ) && SHOW_FILE_NAME ) :
            ?>
                <span class="file-name">
                    <?php esc_html_e( $args ); ?>
                </span>
            <?php
        endif;
    }

}