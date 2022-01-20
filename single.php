<?php
/** Single Template File
 * @package EDigitalX
 */

    namespace THEME\Inc;
    use THEME\Inc\Traits\Singleton;

    # TODO: Fatal error: Uncaught Error: Non-static method THEME\Inc\MetaBoxes::set_post_views() cannot be called statically
    //MetaBoxes :: set_post_views( get_the_ID() );   /** Establece cuenta para publicaciones vistas */

    get_header();
    do_action( 'get_file_name', basename( __FILE__ ) );
?>

    <?php while ( have_posts() ) : the_post(); ?>

        <?php
            //  Configura despliege de tiempo estimado de lectura  
            $args = theme_get_estimated_reading_time();
            $args[ 'is_entry_featured' ] = false;
            get_template_part( 'template-parts/entry', 'header', $args );
            get_template_part( 'template-parts/entry', 'content' ); 
        ?>
        
        <?php
            $filter_related_posts = get_post_meta( get_the_ID(), 'list_related_entries', true ); 
            #echo '<pre>';  var_dump( $filter_related_posts );   echo '</pre>';

            if( ! empty( $filter_related_posts ) ) :
                $args[ 'post_id' ] = $post -> ID;
                $args[ 'related_post' ] = $filter_related_posts;
                get_template_part( 'template-parts/related', 'post', $args );
            endif;

            $filter_related_posts = get_post_meta( get_the_ID(), 'list_related_entries', true ); 
        ?>

        <?php comments_template(); ?>

    <?php endwhile; ?>

<?php
    get_footer();