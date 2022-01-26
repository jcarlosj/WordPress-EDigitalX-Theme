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

                //  Configura despliege de tiempo estimado de lectura  
                $args = theme_get_estimated_reading_time();
                $args[ 'is_entry_featured' ] = false;

            ?>

                <article class="entry">
                    
                    <div class="entry-last <?php echo $args[ 'is_entry_featured' ] ? 'entry-featured__thumbnail--position' : 'entry__thumbnail--position'; ?>">
                        <a
                            class="<?php echo $args[ 'is_entry_featured' ] ? 'entry-featured__thumbnail--linkable ' : 'entry__thumbnail--linkable'; ?>" 
                            href="<?php the_permalink(); ?>"
                        >
                            <?php get_template_part( 'template-parts/entry', 'thumbnail', $args ); ?>
                        </a>
                    </div>

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