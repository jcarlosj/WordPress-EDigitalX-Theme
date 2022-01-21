<?php
/** Publish posts related to the content template file by content or tag (Blog)
 * @package EDigitalX
 */
?>

<?php
    if( isset ( $args ) ) :
        //echo '<pre>';  print_r( $args );   echo '</pre>';
        $post_id = $args[ 'post_id' ];

        $entry_data = ( $args[ 'related_post' ] == 'categories' ) 
            ?   get_the_category( $post_id )                    //  Recupera categorias de una entrada
            :   ( ( $args[ 'related_post' ] == 'tags' )
                    ?   $tags = wp_get_post_tags( $post_id )    //  Recupera etiquetas de una entrada
                    :   null 
                ); 

    //echo '<pre>';  print_r( $entry_data );   echo '</pre>';

    if( $entry_data ) :
        $ids = [];

        foreach( $entry_data as $single_entry_data )
            $ids[] = $single_entry_data -> term_id;

        #echo '<pre>';  print_r( $ids );   echo '</pre>';

        $query_filter = [
            'post__not_in'  => [ $post_id ],
            'posts_per_page' => 3,
            'ignore_sticky_posts' => 1
        ];

        if( $args[ 'related_post' ] == 'categories' ) :
            $query_filter[ 'category__in' ] = $ids; 

        elseif( $args[ 'related_post' ] == 'tags' ) :
            $query_filter[ 'tag__in' ] = $ids;

        endif;

        $query = new wp_query( $query_filter );

        #echo '<pre>';  print_r( $query -> found_posts );   echo '</pre>';
        
        if( $query -> found_posts > 0 ) :

            ?>
                <div class="container">
                    <h3 class="title-related-posts"><?php _e( 'Related posts', 'edigitalx' ); ?></h3>

                    <section class="related-posts">
                        <?php
                            while( $query -> have_posts() ) :
                                $query -> the_post();

                                ?>
                                    <article class="card">
                                    
                                        <div class="<?php echo $args[ 'is_entry_featured' ] ? 'entry-featured__thumbnail--position' : 'entry__thumbnail--position'; ?>">

                                            <a
                                                class="<?php echo $args[ 'is_entry_featured' ] ? 'entry-featured__thumbnail--linkable ' : 'entry__thumbnail--linkable'; ?>" 
                                                href="<?php the_permalink(); ?>"
                                            >
                                                <?php
                                                    if( has_post_thumbnail( get_the_ID() ) ) :

                                                        if( $args[ 'is_entry_featured' ] ) :

                                                            the_post_thumbnail(
                                                                'entry-square',
                                                                [
                                                                    'class' => 'entry-featured__image entry-featured__image--rounded'
                                                                ]
                                                            );

                                                        else :

                                                            the_post_thumbnail(
                                                                'entry-landscape',
                                                                [
                                                                    'class' => 'entry__image entry__image--rounded'
                                                                ]
                                                            );

                                                        endif;

                                                    else :
                                                        has_no_featured_image();
                                                    endif;

                                                ?>
                                            </a>

                                        </div>
                                        <header class="entry__header">

                                            <span class="entry__categories">
                                                <?php the_category( ' ' ); ?>
                                            </span>

                                            <h2 class="<?php echo $args[ 'is_entry_featured' ] ? 'entry-featured__title' : 'entry__title'; ?>">
                                                <a class="entry__title-link" href="<?php the_permalink(); ?>">

                                                    <?php if( $args[ 'is_entry_featured' ] ) : ?>

                                                        <?php
                                                            $title = theme_limit_string_length( get_the_title(), 60 );
                                                            echo esc_html( $title );
                                                        ?>

                                                    <?php else: ?>

                                                        <?php the_title(); ?>

                                                    <?php endif; ?>

                                                </a>
                                            </h2>

                                        </header>
                                        <p class="entry__excerpt">

                                            <?php if( has_excerpt() ): ?>

                                                <?php
                                                    $excerpt = wp_strip_all_tags( get_the_excerpt() );
                                                    echo $excerpt;
                                                ?>

                                            <?php else: ?>

                                                <?php echo wp_trim_words( get_the_content(), 18, '..' ); ?>

                                            <?php endif; ?>

                                        </p>
                                        <footer class="entry__footer">
                                            <time class="entry__time" datetime="<?php the_time( 'Y-m-d' ); ?>">

                                                <?php
                                                    if( $args[ 'has_estimated_time' ] ) :
                                                        ?>
                                                            <span class="<?php echo $args[ 'is_entry_featured' ] ? 'entry-featured__time-read' : 'entry__time-read'; ?>">
                                                                <?php echo $args[ 'estimated_time' ]; ?>
                                                                <?php esc_html_e( 'min read', 'edigitalx' ); ?>
                                                            </span>
                                                        <?php
                                                    endif;
                                                ?>
                                                <span class="<?php echo $args[ 'is_entry_featured' ] ? 'entry-featured__date' : 'entry__date'; ?>"><?php echo get_the_time( 'M' ); ?> <?php echo get_the_time( 'd' ); ?>, <?php echo get_the_time( 'Y' ); ?></span>

                                            </time>
                                        </footer>

                                    </article>

                                <?php
                            endwhile;        
                        ?>
                    </section>
                </div>
            <?php

        endif;
    endif;
    wp_reset_query();
    
    endif;

?>