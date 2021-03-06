<div id="recommended-posts" class="featured-panel">

    <?php
        $args = array (
            'posts_per_page' => 3,
            'meta_key' => 'featured_post',       //  Nombre del Meta Box
            'orderby' => 'yes',
        );

        $featured_post = new WP_Query( $args );

        // echo '<pre>';   var_dump( $featured_post );     echo '</pre>';

        if ( $featured_post -> have_posts() ) :
            while( $featured_post -> have_posts() ) :
                $featured_post -> the_post();

                //  Configura despliege de tiempo estimado de lectura  
                $args = theme_get_estimated_reading_time();
                $args[ 'is_entry_featured' ] = true;
                $args[ 'image_size' ] = ( wp_is_mobile() ) ? 'entry-square-mobile' : 'entry-square' ;

                ?>

                    <article class="entry entry-recommended <?php echo $args[ 'is_entry_featured' ] ? 'entry-featured__content--position' : ''; ?>">
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