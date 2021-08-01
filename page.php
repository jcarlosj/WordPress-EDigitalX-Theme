<?php
/** Page Template File
 * @package EDigitalX
 */

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

    <?php endwhile; ?>

<?php
    get_footer();
