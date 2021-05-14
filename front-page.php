<?php
/** Front-Page Template File 
 * @package EDigitalX
 */

    get_header();
    do_action( 'get_file_name', basename( __FILE__ ) );
?>
   
    <div id="site-container" class="front-page">

        <section class="posts-featured">
            <div class="container">
                <div class="featured-content">
                    
                    <?php get_template_part( 'template-parts/entries-featured/entry', 'last' ); ?>

                    <div class="posts-featured-sidebar">

                        <?php get_template_part( 'template-parts/entries-featured/entries', 'tabs' ); ?>
                        <?php get_template_part( 'template-parts/entries-featured/entries', 'popular' ); ?>
                        <?php get_template_part( 'template-parts/entries-featured/entries', 'recommended' ); ?>
                        
                    </div><!-- .posts-featured-sidebar  -->

                </div>
            </div>
        </section>

    </div>

<?php 
    get_footer();