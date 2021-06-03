<?php
/** Page Template File
 * @package EDigitalX
 */

    get_header();
    do_action( 'get_file_name', basename( __FILE__ ) );
?>


    <?php while ( have_posts() ) : the_post(); ?>

        <?php
            get_template_part( 'template-parts/entry', 'header' );
            get_template_part( 'template-parts/entry', 'content' );
        ?>

    <?php endwhile; ?>

<?php
    get_footer();
