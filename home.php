<?php
/** Home Template File (Blog)
 * @package PizzaShop
 */

    namespace THEME\Inc;
    use THEME\Inc\Traits\Singleton;

    get_header();
    do_action( 'get_file_name', basename( __FILE__ ) );
?>

    <?php
        $blog_page_id = get_option( 'page_for_posts' );     //  El valor de 'page_for_posts' puede consultarse en: http://localhost:8080/wp-admin/options.php 
        $featured_image_id = get_post_thumbnail_id( $blog_page_id );
        if( $featured_image_id ) {
            $image_source = wp_get_attachment_image_src( $featured_image_id, 'full' ) [ 0 ];
        }

        /** Obtenemos el numero de paginas */
        $paged = ( get_query_var( 'paged' ) )
            ?   get_query_var( 'paged' )
            :   1;

        $about_publications = wpex_general_data( $posts_per_page ); 
        //echo '<pre>';   print_r( $about_publications ); echo '</pre>';
    ?>

        <header
            class="hero"
            <?php if( $featured_image_id ) : ?>
                style="background-image: url( <?php echo $image_source; ?> );"
            <?php else: ?>

            <?php endif; ?>
        >

            <div class="container">

                <h1 class="hero__title"><?php echo get_the_title( $blog_page_id ); ?></h1>
                <ul class="hero__data">

                    <li class="hero__item hero__item--publish">
                        <span class="hero__number hero__number--publish">
                            <?php echo $about_publications[ 'authors' ]; ?>
                        </span>
                        <span class="hero__description hero__description--publish">
                            <?php esc_html_e( 'Authors', 'edigitalx' ); ?>
                        </span>
                    </li>

                    <li class="hero__item hero__item--publish">
                        <span class="hero__number hero__number--publish">
                            <?php echo $about_publications[ 'published_post_count' ]; ?>
                        </span>
                        <span class="hero__description hero__description--publish">
                            <?php esc_html_e( 'Publish', 'edigitalx' ); ?>
                        </span>
                    </li>

                    <li class="hero__item hero__item--pages">
                        <span class="hero__number hero__number--pages">
                            <?php echo $about_publications[ 'total_pages' ]; ?>
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

                <?php
                    /** Verifica que solo se vea la ultima entrada en la primera pagina */
                    if( $paged <= 1 ) :

                        ?>

                        <!-- <section class="posts-featured">
                            <div class="container">
                                <div class="featured-content">

                                    <?php #get_template_part( 'template-parts/entries-featured/entry', 'last' ); ?>

                                    <div class="posts-featured-sidebar">

                                        hello!

                                    </div><!-- .posts-featured-sidebar  -->

                                <!-- </div>
                            </div>
                        </section> -->

                        <?php

                    endif;
                ?>

                <section class="container entries-blog">

                    <?php 

                        /** Escribimos la logica de compensacion del query aqu?? para evitar que afecte a otros queries que se hacen en este archivo, por ejemplo el template part: 
                         *  entry_last.php (linea 80) */

                        # Verifica si estamos en el home.php
                        if( is_home() ) :
                            # TODO: Uncaught Error: Non-static method THEME\Inc\Queries::home_offset_exclude_latest_post() cannot be called statically
                            //$arr_args = Queries :: home_offset_exclude_latest_post();
                            //query_posts( $arr_args );

                            /** The Loop */
                            while ( have_posts() ) :
                                the_post();

                                //  Configura despliege de tiempo estimado de lectura  
                                $args = theme_get_estimated_reading_time();
                                $args[ 'is_entry_featured' ] = false;
                                $args[ 'image_size' ] = ( wp_is_mobile() ) ? 'entry-classic-mobile' : 'entry-classic' ;
                    ?>

                                    <article class="entry entry-classic entry-blog">

                                        <div class="<?php echo $args[ 'is_entry_featured' ] ? 'entry-featured__thumbnail--position' : 'entry__thumbnail--position'; ?>">
                                            <a
                                                class="<?php echo $args[ 'is_entry_featured' ] ? 'entry-featured__thumbnail--linkable ' : 'entry__thumbnail--linkable'; ?>" 
                                                href="<?php the_permalink(); ?>"
                                            >
                                                <?php get_template_part( 'template-parts/entry', 'thumbnail', $args ); ?>
                                            </a>
                                        </div>

                                        <div class="<?php echo $args[ 'is_entry_featured' ] ? 'entry-featured entry-featured__content--size entry-featured__content--position' : 'entry__content entry__content--size entry__content--position'; ?>">

                                            <?php get_template_part( 'template-parts/entry', 'header', $args ); ?>
                                            <?php get_template_part( 'template-parts/entry', 'content' ); ?>
                                            <?php get_template_part( 'template-parts/entry', 'footer', $args ); ?>

                                        </div>

                                    </article>

                    <?php
                            endwhile;
                        endif;  # if( is_home() )
                    ?>

                </section>

                <section class="entries-pagination">

                    <?php
                        get_template_part( 'template-parts/entry', 'pagination' );
                    ?>

                </section>

            </main>

            <?php #get_sidebar() ?>

        </section>

<?php
    get_footer();
