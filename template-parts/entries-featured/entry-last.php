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

                <?php
                    $args = [
                        'is_entry_featured'  => false,
                        'has_estimated_time' => $has_estimated_time,
                        'estimated_time'     => $estimated_time
                    ];
                ?>

                <article class="entry">

                    <?php get_template_part( 'template-parts/entry', 'thumbnail', $args ); ?>

                    <div class="entry__content <?php echo $args[ 'is_entry_featured' ] ? 'entry-featured__content--size entry-featured__content--position' : 'entry__content--size entry__content--position'; ?>">

                        <?php get_template_part( 'template-parts/entry', 'header', $args ); ?>
                        <?php get_template_part( 'template-parts/entry', 'content' ); ?>
                        <?php get_template_part( 'template-parts/entry', 'footer', $args ); ?>

                    </div>

                </article><!-- .entry -->

            <?php

        endwhile;
    else:
    endif;
    wp_reset_postdata();
?>