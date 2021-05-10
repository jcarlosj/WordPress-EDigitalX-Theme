<?php
    $args = array (
        'post_type' => 'post',
        'posts_per_page' => 1,
        'orderby' => 'post_date',
        'order' => 'DESC',
    );

    $popular_posts = new WP_Query( $args );

    // echo '<pre>';   var_dump( $popular_posts );     echo '</pre>';   

    if ( $popular_posts -> have_posts() ) : 
        while( $popular_posts -> have_posts() ) : 
            $popular_posts -> the_post(); 

            $estimated_time = get_post_meta( get_the_ID(), 'estimated_reading_time', true );        #   Obtengo el valor del Meta Box
            $has_estimated_time = ( $estimated_time == '' || $estimated_time == 0 ) ? false : true;

            ?>

                <article class="entry">

                    <div class="entry__thumbnail entry__thumbnail--position">
                        <a class="entry__thumbnail-link" href="<?php the_permalink(); ?>">
                            <?php 
                                the_post_thumbnail( 
                                    'entry-landscape', 
                                    [
                                        'class' => 'entry__featured-image entry__featured-image--rounded'
                                    ]
                                ); ?>
                        </a>
                    </div>

                    <div class="entry__content entry__content--size entry__content--position">

                        <header class="entry__header">
                                            
                            <span class="entry__categories">
                                <?php the_category( ' ' ); ?>
                            </span>
                            
                            <h2 class="entry__title">
                                <a class="entry__title-link" href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
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
                                    if( $has_estimated_time ) :
                                        ?>
                                            <span class="entry__time-read"><?php echo $estimated_time; ?> <?php esc_html_e( 'min read', 'edigitalx' ); ?></span>
                                        <?php
                                    endif;
                                ?>
                                <span class="entry__date"><?php echo get_the_time( 'M' ); ?> <?php echo get_the_time( 'd' ); ?>, <?php echo get_the_time( 'Y' ); ?></span>
                        
                            </time>
                        </footer>

                    </div>

                </article><!--  -->

            <?php

        endwhile;
    else:
    endif;
    wp_reset_postdata(); 
?>