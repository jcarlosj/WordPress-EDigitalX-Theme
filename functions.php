<?php
/** Theme Functions
 * @package EDigitalX
 */

if( ! defined( 'THEME_DIR_PATH' ) ) {
    define( 
        'THEME_DIR_PATH', 
        untrailingslashit( get_template_directory() )     // WP Func: Elimina las barras inclinadas hacia adelante y hacia atrás si existen.
    );
}

require_once THEME_DIR_PATH .'/inc/helpers/global.php';         //  Incluirá todas las definiciones globales para el tema
require_once THEME_DIR_PATH. '/inc/helpers/autoloader.php';    //  Incluirá automáticamente todas las clases que definamos 
require_once THEME_DIR_PATH. '/inc/helpers/template-tags.php'; //  Incluirá fragmentos de código que pueden ser utilizados en toda la aplicación

function get_theme_instance() {
	\THEME\Inc\Theme::get_instance();
}

get_theme_instance();

/** Ajusta paginacion al desplazamiento producido por un cambio en el query */
function adjust_offset_pagination( $found_posts, $query ) {

    # Define nuevo desplazamiento...
    $offset = 1;

    # Asegúrese de que estamos modificando el objeto de consulta correcto ...
    if ( $query -> is_home() ) {

        #Reducir el recuento de publicaciones encontradas de WordPress por el desplazamiento ...
        return $found_posts - $offset;
  }

  return $found_posts;
}
add_filter( 'found_posts', 'adjust_offset_pagination', 1, 2 );