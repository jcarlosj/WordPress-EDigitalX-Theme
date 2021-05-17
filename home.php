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

                <h1 class="hero__title"><?php echo get_the_title( $blog_page_id ); ?></h1>
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

                <?php
                    /** Verifica que solo se vea la ultima entrada en la primera pagina */
                    if( $paged <= 1 ) : 
                        
                        ?>
                        
                        <section class="posts-featured">
                            <div class="container">
                                <div class="featured-content">
                                    
                                    <?php get_template_part( 'template-parts/entries-featured/entry', 'last' ); ?>

                                    <div class="posts-featured-sidebar">

                                        hello!
                                        
                                    </div><!-- .posts-featured-sidebar  -->

                                </div>
                            </div>
                        </section>

                        <?php

                    endif;
                ?>

                <section class="container entries-blog">

                    <?php 

                        /** Escribimos la logica de compensacion del query aquí para evitar que afecte a otros queries que se hacen en este archivo, por ejemplo el template part: 
                         *  entry_last.php (linea 80) */

                        # Verifica si estamos en el home.php
                        if( is_home() ) :

                            $post_per_page = get_option( 'posts_per_page' );                        #   Obtiene valor predeterminado de publicaciones por pagina
                            $offset = 1;                                                            #   Desplazamiendo para excluir la última publicación
                            $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;   #   Obtenemos la pagina actual

                            # Verifica si es un resultado paginado.
                            if( is_paged() ) :
                                # No es la primera pagina, es para un resultado paginado.

                                # Determine manualmente el desplazamiento de la consulta de la página (desplazamiento + página actual (menos uno) x publicaciones por página)
                                $page_offset = $offset + ( ( $paged - 1 ) * $post_per_page );

                                #echo "Paginado: $page_offset";

                                # Aplicar ajustar desplazamiento de página
                                query_posts( [
                                    'offset' => $page_offset,   
                                    'paged' => $paged 
                                ]); 
                            else :     
                                #echo "Pagina principal: $offset";

                                # Ésta es la primera página. Solo usa el desplazamiento.
                                query_posts( [
                                    'offset' => $offset,            # Excluye N publicaciones (a partir de la última realizada)
                                    'paged' => $paged 
                                ]);
                            endif;

                            /** The Loop */
                            while ( have_posts() ) : 
                                the_post();


                                $estimated_time = get_post_meta( get_the_ID(), 'estimated_reading_time', true );        #   Obtengo el valor del Meta Box
                                $has_estimated_time = ( $estimated_time == '' || $estimated_time == 0 ) ? false : true;

                                $args = [ 
                                    'is_entry_featured'  => true,
                                    'has_estimated_time' => $has_estimated_time,
                                    'estimated_time'     => $estimated_time
                                ];
                        ?>

                            <article class="entry entry-blog">
                                
                                <?php get_template_part( 'template-parts/entry', 'thumbnail' ); ?>

                                <div class="entry__content <?php echo $args[ 'is_entry_featured' ] ? 'entry-featured entry-featured__content--size entry-featured__content--position' : 'entry__content entry__content--size entry__content--position'; ?>">

                                    <?php get_template_part( 'template-parts/entry', 'header' ); ?>
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

            <?php get_sidebar() ?>

        </section>

    </div>

<?php 
    get_footer();
