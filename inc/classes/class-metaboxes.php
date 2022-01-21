<?php
/** Register modifications to publications or entries
 * @package EDigitalX
 */

namespace THEME\Inc;

use THEME\Inc\Traits\Singleton;

class MetaBoxes {
    use Singleton;

    private $class_name = 'edigitalx';

    protected function __construct() {
        // wp_die( 'Class Meta Boxes' );

        //  Cargamos Clases.
        $this -> setup_hooks_featured_post();
        $this -> setup_hooks_post_views_count();
        $this -> setup_hooks_estimated_reading_time();
        $this -> setup_hooks_entry_title();
        $this -> setup_hooks_related_post();
    }

    protected function setup_hooks_featured_post() {

        /** Actions */
        add_action( 'add_meta_boxes', [ $this, 'meta_box_featured_post' ] );
        add_action( 'save_post', [ $this, 'meta_box_featured_post_save' ], 10, 3 );
    }

    protected function setup_hooks_post_views_count() {

        /** Actions */
        add_filter( 'manage_posts_columns', [ $this, 'add_columns_to_admin_posts' ] );
        add_action( 'manage_posts_custom_column', [ $this, 'posts_custom_column_views' ], 5, 2 );
        add_action( 'manage_posts_custom_column', [ $this, 'posts_custom_column_featured_image' ], 5, 2 );
    }

    protected function setup_hooks_estimated_reading_time() {

        /** Actions */
        add_action( 'add_meta_boxes', [ $this, 'meta_box_estimated_reading_time' ] );
        add_action( 'save_post', [ $this, 'meta_box_estimated_reading_time_save' ], 10, 3 );
    }

    protected function setup_hooks_entry_title() {

        /** Actions */
        add_action( 'add_meta_boxes', [ $this, 'meta_box_entry_title' ] );
        add_action( 'save_post', [ $this, 'meta_box_featured_entry_title_save' ], 10, 3 );
    }

    protected function setup_hooks_related_post() { 
        /** Actions */
        add_action( 'add_meta_boxes', [ $this, 'meta_box_related_post' ] );
        add_action( 'save_post', [ $this, 'meta_box_related_post_save' ], 10, 3 );
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

            return __( 'Views', 'edigitalx' ). '<br />0';
        }

        return __( 'Views', 'edigitalx' ). '<br />' . $count;
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
    public function add_columns_to_admin_posts( $defaults ) {

        $defaults[ 'post_views' ] = __( 'Views', 'edigitalx' );
        $defaults[ 'featured_image' ] = __( 'Featured image', 'edigitalx' );

        return $defaults;
    }

    /** Establece los valores de la columna cantidad de vistas para cada publicacion en WP-Admin */
    public function posts_custom_column_views( $column_name, $id ) {

        if( $column_name === 'post_views' ) {
            echo $this -> get_post_views( get_the_ID() );
        }

    }

    /** Establece los valores de la columna imagen destacada para cada publicacion en WP-Admin */
    public function posts_custom_column_featured_image( $column_name, $post_id ) {
        
        if( $column_name === 'featured_image' ) {
            echo has_post_thumbnail( $post_id ) ? __( 'Yes', 'edigitalx' ) :  __( 'No', 'edigitalx' ) ;
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

        #echo '<pre>';  var_dump( $estimated_reading_time );   echo '</pre>';
        #echo '<b>' .$estimated_reading_time. '</b>';

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
                        <?php _e( 'minutes', 'edigitalx' ); ?>
                    </label>
                    <p id="components-form-token-suggestions-howto-0" class="components-form-token-field__help">
                        <?php _e( 'It is recommended to use whole numbers', 'edigitalx' ); ?>
                    </p>

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

    /** Crea Meta Box: Fondo del titulo de publicacion o entrada */
    public function meta_box_entry_title() {
        add_meta_box(
            'edigitalx_mb_entry_title',                         #   ID unico de identificacion
            _x( 'Entry title background', 'edigitalx' ),        #   Titulo para el Metabox
            array( $this, 'meta_box_entry_title_callback' ),    #   Callback: Funcion que dibujará formulario para el Metabox
            array( 'post' ),                                    #   Nombre del Post o los Post a los que se agregará el Metabox
            'side',                                             #   Contexto dentro de la pantalla donde debe mostrarse el cuadro: 'normal', 'side', and 'advanced'. Valor por defecto: 'advanced'
            'default',                                          #   La prioridad dentro del contexto donde debe mostrarse el cuadro: 'high', 'core', 'default', or 'low'. Valor por defecto: 'default'
            null                                                #   Datos que deben establecerse como la propiedad $ args de la matriz de caja (que es el segundo parámetro que se pasa a su devolución de llamada). Valor por defecto: null
        );
    }

    /** Callback para el meta box: Descatar publicacion (formulario) */
    public function meta_box_entry_title_callback( $current_post ) {

        #   Agrega un nonce a un formulario
        wp_nonce_field(
            basename( __FILE__ ),       #   Nombre del archivo actual
            'mb_nonce_entry_title'      #   Nombre temporal para el formulario
        );

        $value_post_title_background = get_post_meta(
            $current_post -> ID,        #   ID del Post
            'post_title_background',    #   Nombre del campo o meta box que se desea obtener
            true                        #   Si se debe devolver un solo valor. Este parámetro no tiene ningún efecto si no se especifica $key. Valor predeterminado: falso
        );

        ?>

            <p>
                <div class="sm-row-content">

                    <label class="label" for="value_post_title_background">
                        <?php _e( 'The background of the post title is:', 'edigitalx' )?>
                    </label>
                    <select name="value_post_title_background" id="value_post_title_background" class="selection-field">
                        <?php
                            if( $value_post_title_background == "" ) :
                                ?>
                                    <option value=""><?php esc_html_e( 'Select...', 'edigitalx' ); ?></option>
                                <?php
                            endif;
                        ?>
                        <option value="dark" <?php selected( $value_post_title_background, 'dark' ); ?> >
                            <?php esc_html_e( 'Dark', 'edigitalx' ); ?>
                        </option>
                        <option value="clear" <?php selected( $value_post_title_background, 'clear' ); ?> >
                            <?php esc_html_e( 'Clear', 'edigitalx' ); ?>
                        </option>
                    </select>

                </div>
            </p>

        <?php
    }

    /** Guarda Meta Box: Valores obtenidos Tiempo estimado de lectura de una publicacion o entrada */
    public function meta_box_featured_entry_title_save( $post_id ) {

        #   Verifica si NO puede validar el nonce del formulario
        if( ! isset( $_POST[ 'mb_nonce_entry_title' ] ) || ! wp_verify_nonce( $_POST[ 'mb_nonce_entry_title' ], basename( __FILE__ ) ) ) {
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

        #   Verifica que el valor de la variable obtenida del formulario esta definida
        if( isset( $_POST[ 'value_post_title_background' ] ) ) {
            $value = $_POST[ 'value_post_title_background' ];
        }

        if( array_key_exists( 'value_post_title_background', $_POST ) ) {
            update_post_meta(
                $post_id,
                'post_title_background',
                $value
            );
        }
    }

    public function meta_box_related_post() {

        add_meta_box(
            'edigitalx_mb_related_post',                    #   ID unico de identificacion
            _x( 'Show related posts', 'edigitalx' ),        #   Titulo para el Metabox
            array( $this, 'meta_box_related_post_callback' ),    #   Callback: Funcion que dibujará formulario para el Metabox
            array( 'post' ),                                    #   Nombre del Post o los Post a los que se agregará el Metabox
            'side',                                             #   Contexto dentro de la pantalla donde debe mostrarse el cuadro: 'normal', 'side', and 'advanced'. Valor por defecto: 'advanced'
            'default',                                          #   La prioridad dentro del contexto donde debe mostrarse el cuadro: 'high', 'core', 'default', or 'low'. Valor por defecto: 'default'
            null                                                #   Datos que deben establecerse como la propiedad $ args de la matriz de caja (que es el segundo parámetro que se pasa a su devolución de llamada). Valor por defecto: null
        );

    }

    public function meta_box_related_post_callback( $current_post ) {
        #   Agrega un nonce a un formulario
        wp_nonce_field(
            basename( __FILE__ ),       #   Nombre del archivo actual
            'mb_nonce_related_post'     #   Nombre temporal para el formulario
        );

        $value_list_related_entries = get_post_meta(
            $current_post -> ID,        #   ID del Post
            'list_related_entries',     #   Nombre del campo o meta box que se desea obtener
            true                        #   Si se debe devolver un solo valor. Este parámetro no tiene ningún efecto si no se especifica $key. Valor predeterminado: falso
        );

        # echo '<pre>';    var_dump( $value_list_related_entries ); echo '</pre><br />';

        ?>

            <p>
                <div class="sm-row-content">

                    <label class="label" for="value_list_related_entries">
                        <?php _e( 'Show posts:', 'edigitalx' )?>
                    </label>
                    <select name="value_list_related_entries" id="value_list_related_entries" class="selection-field">
                        <?php
                            if( $value_list_related_entries == "" ) :
                                ?>
                                    <option value=""><?php esc_html_e( 'Select...', 'edigitalx' ); ?></option>
                                <?php
                            else:
                                ?>
                                    <option value="" <?php selected( $value_list_related_entries, '' ); ?> >
                                        <?php esc_html_e( 'No', 'edigitalx' ); ?>
                                    </option>
                                <?php
                            endif;
                        ?>
                        <option value="categories" <?php selected( $value_list_related_entries, 'categories' ); ?> >
                            <?php esc_html_e( 'By categories', 'edigitalx' ); ?>
                        </option>
                        <option value="tags" <?php selected( $value_list_related_entries, 'tags' ); ?> >
                            <?php esc_html_e( 'By tags', 'edigitalx' ); ?>
                        </option>
                    </select>

                </div>
            </p>

        <?php
    }

    public function meta_box_related_post_save( $post_id ) {

        #   Verifica si NO puede validar el nonce del formulario
        if( ! isset( $_POST[ 'mb_nonce_related_post' ] ) || ! wp_verify_nonce( $_POST[ 'mb_nonce_related_post' ], basename( __FILE__ ) ) ) {
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

        #   Verifica que el valor de la variable obtenida del formulario esta definida
        if( isset( $_POST[ 'value_list_related_entries' ] ) ) {
            $value = $_POST[ 'value_list_related_entries' ];
        }

        if( $value == '' ) {
            delete_post_meta( $post_id, 'list_related_entries' );
        }
        else if( array_key_exists( 'value_list_related_entries', $_POST ) ) {
            update_post_meta(
                $post_id,
                'list_related_entries',
                $value
            );
        }

    }

}