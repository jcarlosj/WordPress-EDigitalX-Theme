<?php
/** 
 * Template Name: Sidebar Post: Template
 * Template Post Type: post
 * @package EDigitalX
 */

    namespace THEME\Inc;
    use THEME\Inc\Traits\Singleton;

    # TODO: Fatal error: Uncaught Error: Non-static method THEME\Inc\MetaBoxes::set_post_views() cannot be called statically
    //MetaBoxes :: set_post_views( get_the_ID() );   /** Establece cuenta para publicaciones vistas */

    get_header();
    do_action( 'get_file_name', basename( __FILE__ ) );
?>

    <div class="template template-single">
        <?php while ( have_posts() ) : the_post(); ?>

            <div class="container-fluid template-hero">    
                <?php 
                    //  Configura despliege de tiempo estimado de lectura  
                    $args = theme_get_estimated_reading_time();
                    $args[ 'is_entry_featured' ] = false;
                    get_template_part( 'template-parts/entry', 'header', $args );
                ?>
            </div>
            
            <div class="container template-content">
                <div class="section content">
                    Contenido
                </div>
                <div class="section aside">
                    <?php get_sidebar(); ?>
                </div>
            </div>

        <?php endwhile; ?>
    </div>


<?php
    get_footer();