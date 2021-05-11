<div id="popular-posts" class="featured-panel is-active">

    <?php
        $args = array (
            'post_type' => 'post',
            'posts_per_page' => 4,
            'meta_key' => 'post_views_count',       //  Nombre del Meta Box
            'orderby' => 'meta_value',
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