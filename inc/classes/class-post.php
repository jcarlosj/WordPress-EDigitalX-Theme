<?php
/** Register modifications to publications or entries
 * @package EDigitalX
 */

namespace THEME\Inc;

use THEME\Inc\Traits\Singleton;

class Post {
    use Singleton;

    protected function __construct() {
        // wp_die( 'Class Post' );

        //  Cargamos Clases.
        $this -> setup_hooks();
    }

    protected function setup_hooks() {

        /** Actions */
        add_action( 'add_meta_boxes', [ $this, 'meta_box_featured_post' ] );
        add_action( 'save_post', [ $this, 'meta_box_featured_post_save' ], 10, 3 );
    }

    /** Crea Meta Box: Destacar publicacion */
    public function meta_box_featured_post() {

        add_meta_box(
            'edigitalx_mb_featured_post',                       #   ID unico de identificacion
            _x( 'Post Featured', 'edigitalx' ),                 #   Titulo para el Metabox
            array( $this, 'meta_box_featured_post_callback' ),        #   Callback: Funcion que dibujará formulario para el Metabox
            array( 'post' ),                                    #   Nombre del Post o los Post a los que se agregará el Metabox
            'side',                                             #   Contexto dentro de la pantalla donde debe mostrarse el cuadro: 'normal', 'side', and 'advanced'. Valor por defecto: 'advanced'
            'default',                                          #   La prioridad dentro del contexto donde debe mostrarse el cuadro: 'high', 'core', 'default', or 'low'. Valor por defecto: 'default'
            null                                                #   Datos que deben establecerse como la propiedad $ args de la matriz de caja (que es el segundo parámetro que se pasa a su devolución de llamada). Valor por defecto: null
        );

    }

    /** Callback para el meta box: Descatar publicacion (formulario) */
    public function meta_box_featured_post_callback( $current_post ) {

        #   Agrega un nonce a un formulario
        wp_nonce_field( 
            basename( __FILE__ ),       #   Nombre del archivo actual
            'mb_nonce_featured_post'    #   Nombre temporal para el formulario
        );

        $featured = get_post_meta( 
            $current_post -> ID,        #   ID del Post
            'featured_post',            #   Nombre del campo o meta box que se desea obtener
            true                        #   Si se debe devolver un solo valor. Este parámetro no tiene ningún efecto si no se especifica $key. Valor predeterminado: falso
        );

        // echo '<pre>';  var_dump( $featured );   echo '</pre>';
        // echo '<b>' .$featured. '</b>';

        ?>

            <p>
                <div class="sm-row-content">
                    
                    <input 
                        type="checkbox" 
                        name="featured_post" 
                        id="featured-post" 
                        value="yes" 
                        <?php isset( $featured ) ? checked( $featured, 'yes' ) : '';     # Valida si el campo debe estar seleccionado o no ?> 
                    />
                    <label for="featured-post">
                        <?php _e( 'Make the post featured', 'edigitalx' )?>
                    </label>
                    
                </div>
            </p>
    
        <?php
    }

    /** Guarda Meta Box: Valores obtenidos */
    public function meta_box_featured_post_save( $post_id, $current_post, $update ) {

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
        
}