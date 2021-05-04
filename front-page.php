<?php
/** Front-Page Template File 
 * @package EDigitalX
 */

    get_header();
    do_action( 'get_file_name', basename( __FILE__ ) );
?>
   
    <div id="site-container">

        <section class="posts-featured">
            <div class="container">
                <div class="featured-content">
                    
                    <?php get_template_part( 'template-parts/posts-featured/last', 'post' ); ?>

                    <div class="posts-featured-sidebar">

                        <?php get_template_part( 'template-parts/posts-featured/posts-featured', 'tabs' ); ?>
                        <?php get_template_part( 'template-parts/posts-featured/popular', 'posts' ); ?>
                        <?php get_template_part( 'template-parts/posts-featured/recommended', 'posts' ); ?>
                        
                    </div><!-- .posts-featured-sidebar  -->

                </div>
            </div>
        </section>


    </div>

<?php 
    get_footer();