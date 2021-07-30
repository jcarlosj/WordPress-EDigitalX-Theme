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

        <div class="container file-name">
            <span>
                <?php esc_html_e( basename( __FILE__ ) ); ?>
            </span>
        </div>

        <?php
            //  Configura despliege de tiempo estimado de lectura  
            $args = theme_get_estimated_reading_time();
            $args[ 'is_entry_featured' ] = false;
        ?>

        <?php get_template_part( 'template-parts/entry', 'header', $args ); ?>
        <?php get_template_part( 'template-parts/entry', 'content' ); ?>

        <?php comments_template(); ?>

    <?php endwhile; ?>

<?php
    get_footer();