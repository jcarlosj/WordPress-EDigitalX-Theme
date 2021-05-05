<?php
/** Home Template File (Blog)
 * @package PizzaShop
 */

    get_header();
    
    $blog_page_id = get_option( 'page_for_posts' );     //  El valor de 'page_for_posts' puede consultarse en: http://localhost:8080/wp-admin/options.php 
    $featured_image_id = get_post_thumbnail_id( $blog_page_id );
    $image_source = wp_get_attachment_image_src( $featured_image_id, 'full' ) [ 0 ];

    // var_dump( $image_source );
?>

    <div id="site-container" class="page-file">

        <header 
                class="hero"
                <?php if( $featured_image_id) : ?>
                    style="background-image: url( <?php echo $image_source; ?> );"
                <?php else: ?>
                    
                <?php endif; ?>
        >
            <div class="hero-content container">
                <h1><?php echo get_the_title( $blog_page_id ); ?></h1>
            </div>
        </header>

        <section class="section container with-sidebar">
            <main class="main-content">

                <section class="entries-blog">

                    <?php while ( have_posts() ) : the_post(); ?>

                        <article class="entry entry-blog">
                            
                            <?php 
                                get_template_part( 'template-parts/entry', 'header' ); 
                                get_template_part( 'template-parts/entry', 'content' );
                                get_template_part( 'template-parts/entry', 'footer' ); 
                            ?>

                        </article>
                        
                    <?php endwhile; ?>

                </section>
                
                <section class="entries-pagination">

                    <?php 
                        get_template_part( 'template-parts/entry', 'pagination' );
                    ?>

                </section>

            </main>

            <?php get_sidebar() ?>

        </section>

    </div>

<?php 
    get_footer();
