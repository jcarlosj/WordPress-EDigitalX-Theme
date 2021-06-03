<?php
/** Register modifications to publications or entries
 * @package EDigitalX
 */

namespace THEME\Inc;

use THEME\Inc\Traits\Singleton;

class MetaBoxes {
    use Singleton;

    protected function __construct() {
        // wp_die( 'Class Meta Boxes' );

        //  Cargamos Clases.
        $this -> setup_hooks_featured_post();
        $this -> setup_hooks_post_views_count();
        $this -> setup_hooks_estimated_reading_time();
    }

    protected function setup_hooks_featured_post() {

        /** Actions */
        add_action( 'add_meta_boxes', [ $this, 'meta_box_featured_post' ] );
        add_action( 'save_post', [ $this, 'meta_box_featured_post_save' ], 10, 3 );
    }

    protected function setup_hooks_post_views_count() {

        /** Actions */
        add_filter( 'manage_posts_columns', [ $this, 'posts_column_views' ] );
        add_action( 'manage_posts_custom_column', [ $this, 'posts_custom_column_views' ], 5, 2 );
    }

    protected function setup_hooks_estimated_reading_time() {

        /** Actions */
        add_action( 'add_meta_boxes', [ $this, 'meta_box_estimated_reading_time' ] );
        add_action( 'save_post', [ $this, 'meta_box_estimated_reading_time_save' ], 10, 3 );
    }

    /** Crea Meta Box: Destacar publicacion */
    public function meta_box_featured_post() {

        add_meta_box(
            'edigitalx_mb_featured_post',                       #   ID unico de identificacion
            _x( 'Post Featured', 'edigitalx' ),                 #   Titulo para el Metabox
            array( $this, 'meta_box_featured_post_callback' ),  #   Callback: Funcion que dibujará formulario para el Metabox
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

    /** Obtener vistas de publicaciones */
    public function get_post_views( $post_id ){

        $count_key = 'post_views_count';
        $count = get_post_meta( $post_id, $count_key, true );

        if( $count == '' ) {

            delete_post_meta( $post_id, $count_key );
            add_post_meta( $post_id, $count_key, '0' );

            return '0 '. __( 'View', 'edigitalx' );
        }

        return $count .' '. __( 'Views', 'edigitalx' );
    }

    /** Establecer vistas de publicaciones */
    public function set_post_views( $post_id ) {

        $count_key = 'post_views_count';
        $count = get_post_meta( $post_id, $count_key, true );

        if( $count == '' ) {
            $count = 0;

            delete_post_meta( $post_id, $count_key );
            add_post_meta( $post_id, $count_key, '0' );
        }
        else {
            $count++;
            update_post_meta( $post_id, $count_key, $count );
        }

    }

    /** Establece un titulo para la columna en WP-Admin */
    public function posts_column_views( $defaults ) {

        $defaults[ 'post_views' ] = __( 'Views', 'edigitalx' );

        return $defaults;
    }

    /** Establece los valores de la columna para cada publicacion en WP-Admin */
    public function posts_custom_column_views( $column_name, $id ) {

        if( $column_name === 'post_views' ) {
            echo $this -> get_post_views( get_the_ID() );
        }

    }

    /** Crea Meta Box: Tiempo estimado de lectura de una publicacion o entrada */
    public function meta_box_estimated_reading_time() {

        add_meta_box(
            'edigitalx_mb_estimated_reading_time',              #   ID unico de identificacion
            _x( 'Estimated Reading Time', 'edigitalx' ),        #   Titulo para el Metabox
            array( $this, 'meta_box_estimated_reading_time_callback' ),  #   Callback: Funcion que dibujará formulario para el Metabox
            array( 'post' ),                                    #   Nombre del Post o los Post a los que se agregará el Metabox
            'side',                                             #   Contexto dentro de la pantalla donde debe mostrarse el cuadro: 'normal', 'side', and 'advanced'. Valor por defecto: 'advanced'
            'default',                                          #   La prioridad dentro del contexto donde debe mostrarse el cuadro: 'high', 'core', 'default', or 'low'. Valor por defecto: 'default'
            null                                                #   Datos que deben establecerse como la propiedad $ args de la matriz de caja (que es el segundo parámetro que se pasa a su devolución de llamada). Valor por defecto: null
        );

    }

    /** Callback para el meta box: Tiempo estimado de lectura de una publicacion o entrada (formulario) */
    public function meta_box_estimated_reading_time_callback( $current_post ) {

        #   Agrega un nonce a un formulario
        wp_nonce_field(
            basename( __FILE__ ),       #   Nombre del archivo actual
            'mb_nonce_estimated_reading_time'    #   Nombre temporal para el formulario
        );

        $estimated_reading_time = get_post_meta(
            $current_post -> ID,        #   ID del Post
            'estimated_reading_time',   #   Nombre del campo o meta box que se desea obtener
            true                        #   Si se debe devolver un solo valor. Este parámetro no tiene ningún efecto si no se especifica $key. Valor predeterminado: falso
        );

        $estimated_time = $estimated_reading_time == '' ? 0 : $estimated_reading_time;

        echo '<pre>';  var_dump( $estimated_reading_time );   echo '</pre>';
        echo '<b>' .$estimated_reading_time. '</b>';

        ?>

            <p>
                <div class="sm-row-content">

                    <input
                        type="number"
                        name="estimated_reading_time"
                        id="estimated_reading_time"
                        value="<?php echo $estimated_time; ?>"
                        min="0"
                        minlength="2"
                    />
                    <label for="estimated_reading_time">
                        <?php _e( 'minutes', 'edigitalx' )?>
                    </label>

                </div>
            </p>

        <?php
    }

    /** Guarda Meta Box: Valores obtenidos Tiempo estimado de lectura de una publicacion o entrada */
    public function meta_box_estimated_reading_time_save( $post_id, $current_post, $update ) {

        // #   Verifica si NO puede validar el nonce del formulario
        if( ! isset( $_POST[ 'mb_nonce_estimated_reading_time' ] ) || ! wp_verify_nonce( $_POST[ 'mb_nonce_estimated_reading_time' ], basename( __FILE__ ) ) ) {
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
        $estimated_time = 0;

        #   Verifica que el valor de la variable obtenida del formulario esta definida
        if( isset( $_POST[ 'estimated_reading_time' ] ) ) {
            $estimated_time = $_POST[ 'estimated_reading_time' ];
        }

        update_post_meta(
            $post_id,                   #   ID del Post
            'estimated_reading_time',   #   Nombre del campo
            $estimated_time             #   Valor a actualizar
        );

    }

}