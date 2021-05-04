<div id="recommended-posts" class="featured-panel">

    <?php 
        $args = array(
            'posts_per_page' => 5,
            'meta_key' => 'featured_post',
            'meta_value' => 'yes'
        );

        $featured_post = new WP_Query( $args );

        # echo '<pre>';   var_dump( $featured_post );     echo '</pre>';     

        if ( $featured_post -> have_posts() ) : 
            while( $featured_post -> have_posts() ) : 
                $featured_post -> the_post(); 

                $estimated_time = get_post_meta( get_the_ID(), 'estimated_reading_time', true );        #   Obtengo el valor del Meta Box
                $has_estimated_time = ( $estimated_time == '' || $estimated_time == 0 ) ? false : true;

                ?>
                    
                    <article class="post post-featured-link">

                        <?php get_template_part( 'template-parts/entry', 'header' ); ?>
                        <?php get_template_part( 'template-parts/entry', 'content' ); ?>

                    </article><!-- .post .post-featured-link -->

                <?php

            endwhile;
        else:
        endif;
        wp_reset_postdata(); 
    ?>

</div>