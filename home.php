<?php
/** Home Template File (Blog)
 * @package PizzaShop
 */

    get_header();
    do_action( 'get_file_name', basename( __FILE__ ) );
    
    $blog_page_id = get_option( 'page_for_posts' );     //  El valor de 'page_for_posts' puede consultarse en: http://localhost:8080/wp-admin/options.php 
    $featured_image_id = get_post_thumbnail_id( $blog_page_id );
    $image_source = wp_get_attachment_image_src( $featured_image_id, 'full' ) [ 0 ];

    // var_dump( $image_source );
?>

    <div id="site-container" class="home">

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

                <?php get_template_part( 'template-parts/entries-featured/entry', 'last' ); ?>

                <section class="entries-blog">

                    <?php 

                        while ( have_posts() ) : 
                            the_post();

                            // echo '<code>';   var_dump( $wp_query );      echo '</code>';   

                            $estimated_time = get_post_meta( get_the_ID(), 'estimated_reading_time', true );        #   Obtengo el valor del Meta Box
                            $has_estimated_time = ( $estimated_time == '' || $estimated_time == 0 ) ? false : true;

                            $args = [ 
                                'is_entry_featured'  => false,
                                'has_estimated_time' => $has_estimated_time,
                                'estimated_time'     => $estimated_time
                            ];
                    ?>

                        <article class="entry entry-blog">
                            
                            <?php get_template_part( 'template-parts/entry', 'thumbnail' ); ?>

                            <div class="entry__content <?php #echo $args[ 'is_entry_featured' ] ? 'entry-featured__content--size entry-featured__content--position' : 'entry__content--size entry__content--position'; ?>">

                                <?php get_template_part( 'template-parts/entry', 'header' ); ?>
                                <?php get_template_part( 'template-parts/entry', 'content' ); ?>
                                <?php get_template_part( 'template-parts/entry', 'footer', $args ); ?>

                            </div>

                        </article>

                    <?php
                        endwhile;          
                    ?>

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
