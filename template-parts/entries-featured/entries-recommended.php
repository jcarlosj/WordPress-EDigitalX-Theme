<div id="recommended-posts" class="featured-panel">

    <?php
        $args = array (
            'posts_per_page' => 4,
            'meta_key' => 'featured_post',       //  Nombre del Meta Box
            'orderby' => 'yes',
        );

        $featured_post = new WP_Query( $args );

        // echo '<pre>';   var_dump( $featured_post );     echo '</pre>';

        if ( $featured_post -> have_posts() ) :
            while( $featured_post -> have_posts() ) :
                $featured_post -> the_post();

                $estimated_time = get_post_meta( get_the_ID(), 'estimated_reading_time', true );        #   Obtengo el valor del Meta Box
                $has_estimated_time = ( $estimated_time == '' || $estimated_time == 0 ) ? false : true;

                ?>

                    <?php
                        $args = [
                            'is_entry_featured'  => true,
                            'has_estimated_time' => $has_estimated_time,
                            'estimated_time'     => $estimated_time
                        ];
                    ?>

                    <article class="entry <?php echo $args[ 'is_entry_featured' ] ? 'entry-featured__content--position' : ''; ?>">

                        <?php get_template_part( 'template-parts/entry', 'thumbnail', $args ); ?>

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