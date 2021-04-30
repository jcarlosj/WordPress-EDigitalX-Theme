<?php
/** Single Template File 
 * @package EDigitalX
 */

    namespace THEME\Inc;

    use THEME\Inc\Traits\Singleton;

    MetaBoxes :: set_post_views( get_the_ID() );   /** Establece cuenta para publicaciones vistas */

    get_header();
    do_action( 'get_file_name', basename( __FILE__ ) );
?>

    <div id="site-container">

        <?php while ( have_posts() ) : the_post(); ?>

        <div class="container file-name">
            <span>
                <?php esc_html_e( basename( __FILE__ ) ); ?>
            </span>
        </div>

        <?php 
            get_template_part( 'template-parts/entry', 'header' ); 
            get_template_part( 'template-parts/entry', 'content' ); 
        ?>

        <?php comments_template(); ?>

        <?php endwhile; ?>

    </div>

<?php 
    get_footer();