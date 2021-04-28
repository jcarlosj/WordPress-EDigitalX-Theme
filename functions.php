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


/** Crea Meta Box: Destacar publicacion */
function edigitalx_meta_box_featured_post() {
    //add_meta_box( 'edigitalx_meta', __( 'Post Destacado', 'edigitalx' ), 'edigitalx_meta_callback', 'post' );

    add_meta_box(
        'edigitalx_meta',                                   #   ID unico de identificacion
        _x( 'Post Destacado', 'edigitalx' ),                #   Titulo para el Metabox
        'edigitalx_meta_box_featured_post_callback',        #   Callback: Funcion que dibujará formulario para el Metabox
        array( 'post' ),                                    #   Nombre del Post o los Post a los que se agregará el Metabox
        'side',                                             #   Contexto dentro de la pantalla donde debe mostrarse el cuadro: 'normal', 'side', and 'advanced'. Valor por defecto: 'advanced'
        'default',                                          #   La prioridad dentro del contexto donde debe mostrarse el cuadro: 'high', 'core', 'default', or 'low'. Valor por defecto: 'default'
        null                                                #   Datos que deben establecerse como la propiedad $ args de la matriz de caja (que es el segundo parámetro que se pasa a su devolución de llamada). Valor por defecto: null
    );

}
 
/** Callback para el meta box: Descatar publicacion (formulario) */
function edigitalx_meta_box_featured_post_callback( $current_post ) {

    #   Agrega un nonce a un formulario
    wp_nonce_field( 
        basename( __FILE__ ),       #   Nombre del archivo actual
        'mb_nonce_featured_post'    #   Nombre temporal para el formulario
    );

    $featured = get_post_meta( 
        $current_post -> ID,        #   ID del Post
    );

    
    echo '<pre>';  var_dump( $featured );   echo '</pre>';
    echo '<b>' .$featured[ 'featured_post' ][ 0 ]. '</b>';

    ?>

        <p>
            <div class="sm-row-content">
                
                <input 
                    type="checkbox" 
                    name="featured_post" 
                    id="featured-post" 
                    value="yes" 
                    <?php isset( $featured[ 'featured_post' ] ) ? checked( $featured[ 'featured_post' ][ 0 ], 'yes' ) : '';     # Valida si el campo debe estar seleccionado o no ?> 
                />
                <label for="featured-post">
                    <?php _e( 'Hacer el post destacado', 'edigitalx' )?>
                </label>
                
            </div>
        </p>
 
    <?php
}
add_action( 'add_meta_boxes', 'edigitalx_meta_box_featured_post' );

/** Guarda Meta Box: Valores obtenidos */
function edigitalx_meta_box_featured_post_save( $post_id, $current_post, $update ) {

    // #   Verifica si NO puede validar el nonce del formulario
    if( ! isset( $_POST[ 'mb_nonce_featured_post' ] ) || ! wp_verify_nonce( $_POST[ 'mb_nonce_featured_post' ], basename( __FILE__ ) ) ) {
        return $post_id;
    }

    #   Verifica si NO puede el usuario editar el post
    if( ! current_user_can( 'edit_post', $post_id ) ) {
        return $post_id;
    }

    #   Verifica si esta definido el DOING_AUTOSAVE
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }

    #   Define variable con un valor por defecto
    $featured_post = '';

    //exit( $_POST[ 'featured_post' ] );

    #   Verifica que el valor de la variable obtenida del formulario esta definida
    if( isset( $_POST[ 'featured_post' ] ) ) {
        $featured_post = $_POST[ 'featured_post' ];
    }
    update_post_meta( 
        $post_id,           #   ID del Post
        'featured_post',    #   Nombre del campo
        $featured_post      #   Valor a actualizar
    );
    
}
add_action( 'save_post', 'edigitalx_meta_box_featured_post_save', 10, 3 );