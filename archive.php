<?php
/** Archive Template File
 * @package EDigitalX
 */

    get_header();
    do_action( 'get_file_name', basename( __FILE__ ) );
?>

    <?php
        /** Obtenemos el numero de paginas */
        $paged = ( get_query_var( 'paged' ) )
            ?   get_query_var( 'paged' )
            :   1;
        # echo 'page: ' .$paged;

        /** */
        $total_post_count = wp_count_posts();
        $published_post_count = $total_post_count -> publish;
        $total_pages = ceil( $published_post_count / $posts_per_page );
    ?>

    <header
        class="hero"
        <?php if( $featured_image_id ) : ?>
            style="background-image: url( <?php echo $image_source; ?> );"
        <?php else: ?>

        <?php endif; ?>
    >
        <div class="container">

            <h1 class="hero__title">
                <?php
                    if( is_category() ) :
                        esc_html_e( 'Category: ', 'edigitalx' ); single_cat_title();
                    elseif( is_author() ) :
                        esc_html_e( 'Author: ', 'edigitalx' ); the_author();
                    endif;
                ?>
            </h1>
            <ul class="hero__data">

                <li class="hero__item hero__item--publish">
                    <span class="hero__number hero__number--publish">
                        <?php echo $published_post_count; ?>
                    </span>
                    <span class="hero__description hero__description--publish">
                        <?php esc_html_e( 'Publish', 'edigitalx' ); ?>
                    </span>
                </li>

                <li class="hero__item hero__item--pages">
                    <span class="hero__number hero__number--pages">
                        <?php echo $total_pages; ?>
                    </span>
                    <span class="hero__description hero__description--pages">
                        <?php esc_html_e( 'Pages', 'edigitalx' ); ?>
                    </span>
                </li>

            </ul>
        </div>

    </header>

    <section class="section with-sidebar">
        <main class="main-content">

            <section class="container entries-blog">

                <?php
                    /** The Loop */
                    while ( have_posts() ) :
                        the_post();

                        //  Configura despliege de tiempo estimado de lectura  
                        $args = theme_get_estimated_reading_time();
                        $args[ 'is_entry_featured' ] = false;
                        
                        ?>

                            <article class="entry entry-blog">

                                <?php get_template_part( 'template-parts/entry', 'thumbnail', $args ); ?>

                                <div class="<?php echo $args[ 'is_entry_featured' ] ? 'entry-featured entry-featured__content--size entry-featured__content--position' : 'entry__content entry__content--size entry__content--position'; ?>">

                                    <?php get_template_part( 'template-parts/entry', 'header', $args ); ?>
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
    </section>

<?php
    get_footer();
