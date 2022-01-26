<div id="popular-posts" class="featured-panel is-active">

    <?php
        $args = array (
            'post_type' => 'post',
            'posts_per_page' => 3,
            'meta_key' => 'post_views_count',       //  Nombre del Meta Box
            'orderby' => 'meta_value',
            'order' => 'DESC',
        );

        $popular_posts = new WP_Query( $args );

        // echo '<pre>';   var_dump( $popular_posts );     echo '</pre>';

        if ( $popular_posts -> have_posts() ) :
            while( $popular_posts -> have_posts() ) :
                $popular_posts -> the_post();

                //  Configura despliege de tiempo estimado de lectura  
                $args = theme_get_estimated_reading_time();
                $args[ 'is_entry_featured' ] = true;

                ?>

                    <article class="entry <?php echo $args[ 'is_entry_featured' ] ? 'entry-featured__content--position' : ''; ?>">

                        <div class="entry-popular <?php echo $args[ 'is_entry_featured' ] ? 'entry-featured__thumbnail--position' : 'entry__thumbnail--position'; ?>">
                            <a
                                class="<?php echo $args[ 'is_entry_featured' ] ? 'entry-featured__thumbnail--linkable ' : 'entry__thumbnail--linkable'; ?>" 
                                href="<?php the_permalink(); ?>"
                            >
                                <?php get_template_part( 'template-parts/entry', 'thumbnail', $args ); ?>
                            </a>
                        </div>

                        <div class="<?php echo $args[ 'is_entry_featured' ] ? 'entry-featured entry-featured__content--size entry-featured__content--position' : 'entry__content entry__content--size entry__content--position'; ?>">

                            <?php get_template_part( 'template-parts/entry', 'header', $args ); ?>
                            <?php get_template_part( 'template-parts/entry', 'footer', $args ); ?>

                        </div>

                    </article><!-- .entry -->

                <?php

            endwhile;
        else:
        endif;
        wp_reset_postdata();
    ?>

</div>