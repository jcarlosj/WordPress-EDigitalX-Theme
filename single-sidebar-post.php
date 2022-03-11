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

    <div class="template template-single single-sidebar-post sidebar-post">
        <?php while ( have_posts() ) : the_post(); ?>

            <section class="container-fluid template-hero section">    
                <?php 
                    //  Configura despliege de tiempo estimado de lectura  
                    $args = theme_get_estimated_reading_time();
                    $args[ 'is_entry_featured' ] = false;
                    get_template_part( 'template-parts/entry', 'header', $args );
                ?>
            </section>
            
            <section class="container template-content sidebar-post-content section">
                <?php get_template_part( 'template-parts/entry', 'content' ); ?>
                <?php get_sidebar(); ?>
            </section>

            <?php get_template_part( 'template-parts/post', 'author' ); ?>
            <?php
                $filter_related_posts = get_post_meta( get_the_ID(), 'list_related_entries', true ); 
                #echo '<pre>';  var_dump( $filter_related_posts );   echo '</pre>';

                if( ! empty( $filter_related_posts ) ) :
                    $args[ 'post_id' ] = $post -> ID;
                    $args[ 'related_post' ] = $filter_related_posts;
                    get_template_part( 'template-parts/related', 'posts', $args );
                endif;

                $filter_related_posts = get_post_meta( get_the_ID(), 'list_related_entries', true ); 
            ?>
            <?php comments_template(); ?>

        <?php endwhile; ?>
    </div>


<?php
    get_footer();