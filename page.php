<?php
/** Page Template File
 * @package EDigitalX
 */

    get_header();
    do_action( 'get_file_name', basename( __FILE__ ) );
?>

    <?php while ( have_posts() ) : the_post(); ?>

        <?php
            $hide_title = get_post_meta( get_the_ID(), 'page_title_hide', true ); 
            // echo '<pre>';  var_dump( $hide_title );   echo '</pre>';
        ?>

        <?php
            //  Configura despliege de tiempo estimado de lectura  
            $args = theme_get_estimated_reading_time();
            $args[ 'is_entry_featured' ] = false;

            if( empty( $hide_title ) || $hide_title == 'no' ) :
                get_template_part( 'template-parts/entry', 'header', $args );
            endif;

            get_template_part( 'template-parts/entry', 'content' );
        ?>

    <?php endwhile; ?>

<?php
    get_footer();
