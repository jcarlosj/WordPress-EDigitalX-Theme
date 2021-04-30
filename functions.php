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

// /** Obtener vistas de publicaciones */
// if ( ! function_exists( 'set_post_views' ) ) {

//     function get_post_views( $post_id ){

//         $count_key = 'post_views_count';
//         $count = get_post_meta( $post_id, $count_key, true );
    
//         if( $count == '' ) { 

//             delete_post_meta( $post_id, $count_key );
//             add_post_meta( $post_id, $count_key, '0' );
            
//             return '0 '. __( 'View', 'edigitalx' );
//         }
    
//         return $count .' '. __( 'Views', 'edigitalx' );
//     }

// }

// /** Establecer vistas de publicaciones */
// if ( ! function_exists( 'set_post_views' ) ) {

//     function set_post_views( $post_id ) {

//         $count_key = 'post_views_count';
//         $count = get_post_meta( $post_id, $count_key, true );
        
//         if( $count == '' ) {
//             $count = 0;
    
//             delete_post_meta( $post_id, $count_key );
//             add_post_meta( $post_id, $count_key, '0' );
//         }
//         else {
//             $count++;
//             update_post_meta( $post_id, $count_key, $count );
//         }

//     }

// }

// /** Agregar a una columna en WP-Admin */
// if ( ! function_exists( 'posts_column_views' ) ) {
    
//     function posts_column_views( $defaults ) {
    
//         $defaults[ 'post_views' ] = __( 'Views', 'edigitalx' );
    
//         return $defaults;
//     }
//     add_filter( 'manage_posts_columns', 'posts_column_views' );

// }
// if ( ! function_exists( 'posts_custom_column_views' ) ) {

//     function posts_custom_column_views( $column_name, $id ) {
        
//         if( $column_name === 'post_views' ) {
//             echo get_post_views( get_the_ID() );
//         }

//     }
//     add_action( 'manage_posts_custom_column', 'posts_custom_column_views', 5, 2 );

// }
