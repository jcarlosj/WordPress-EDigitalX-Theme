<?php
/** Front-Page Template File 
 * @package EDigitalX
 */

    get_header();
    do_action( 'get_file_name', basename( __FILE__ ) );
?>
   
    <div id="site-container">

        <section class="posts-featured">
            <div class="container">
                <div class="featured-content">

                    <?php 
                        $args = array(
                            'numberposts' => 1,         // Number of recent posts thumbnails to display
                            'post_status' => 'publish'  // Show only the published posts
                        );

                        $recent_posts = wp_get_recent_posts( $args );

                        // echo '<pre>';   var_dump( $recent_posts );     echo '</pre>'; 
                        // echo '<pre>';   var_dump( get_the_category( $recent_posts[ 0 ][ 'ID' ] ) );     echo '</pre>'; 
                        // echo '<pre>';   var_dump( get_post_meta( $recent_posts[ 0 ][ 'ID' ], 'estimated_reading_time', true ) );     echo '</pre>'; 

                        $estimated_time = get_post_meta( $recent_posts[ 0 ][ 'ID' ], 'estimated_reading_time', true );      #   Obtengo el valor del Meta Box
                        $has_estimated_time = ( $estimated_time == '' || $estimated_time == 0 ) ? false : true;

                    ?>
                    
                        <article id="post-<?php echo $recent_posts[ 0 ][ 'ID' ]; ?>" class="last-post">

                            <div class="post-media">
                                <a href="<?php echo get_permalink( $recent_posts[ 0 ][ 'ID' ] ); ?>" class="thumbnail-link">    
                                    <?php echo get_the_post_thumbnail( $recent_posts[ 0 ][ 'ID' ], 'posts-featured-landscape-mobile' ); ?>
                                </a>
                            </div>
                            
                            <div class="post-content">
                                
                                <div class="post-catetory">
                                    <a href="#" rel="category tag">
                                        <?php echo get_the_category( $recent_posts[ 0 ][ 'ID' ] ) [ 0 ] -> name; ?>
                                    </a>
                                </div>
                                <a href="<?php echo get_permalink( $recent_posts[ 0 ][ 'ID' ] ); ?>">
                                    <h2 class="post-title"><?php echo $recent_posts[ 0 ][ 'post_title' ]; ?></h2>
                                </a>
                                
                            </div>

                            <time class="post-footer" datetime="<?php the_time( 'Y-m-d' ); ?>">
                                
                                <?php 
                                    if( $has_estimated_time ) :
                                        ?>
                                            <span class="post-read-time"><?php echo $estimated_time; ?> <?php esc_html_e( 'min read', 'edigitalx' ); ?></span>
                                        <?php
                                    endif;
                                ?>
                                <span class="post-date"><?php echo get_the_time( 'M' ); ?> <?php echo get_the_time( 'd' ); ?>, <?php echo get_the_time( 'Y' ); ?></span>

                            </time>

                        </article><!-- #post-## -->

                        <div class="posts-featured-sidebar">

                                <div class="featured-tabs">

                                    <button id="trending" class="btn-trending featured-tab current-tab-item" data-id="#popular-posts">
                                        <?php esc_html_e( 'Trending', 'edigitalx' ); ?>
                                    </button>
                                    <button id="recommended" class="btn-recommended featured-tab" data-id="#recommended-posts">
                                        <?php esc_html_e( 'Recommended', 'edigitalx' ); ?>
                                    </button>
                                                                    
                                </div>
                            
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

                                                        <a href="<?php the_permalink(); ?>" class="post-featured-media">
                                                            <div class="image-wrapper">
                                                                <?php the_post_thumbnail( 'posts-featured-square-mobile' ); ?>
                                                            </div>
                                                        </a>

                                                        <div class="post-featured-content">
                                                            <div class="post-cats post-featured-category">
                                                                <div class="post-catetory">
                                                                    <a href="#" rel="category tag"><?php the_category(', '); ?></a>
                                                                </div>
                                                            </div>
                                                            <h3 class="post-featured-title">
                                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                            </h3>
                                                            <time class="post-footer" datetime="<?php the_time( 'Y-m-d' ); ?>">
                                                                
                                                                <?php 
                                                                    if( $has_estimated_time ) :
                                                                        ?>
                                                                            <span class="post-read-time"><?php echo $estimated_time; ?> <?php esc_html_e( 'min read', 'edigitalx' ); ?></span>
                                                                        <?php
                                                                    endif;
                                                                ?>
                                                                <span class="post-date"><?php echo get_the_time( 'M' ); ?> <?php echo get_the_time( 'd' ); ?>, <?php echo get_the_time( 'Y' ); ?></span>

                                                            </time>
                                                        </div>

                                                    </article><!-- .post .post-featured-link -->
                                
                                                <?php
                                    
                                            endwhile;
                                        else:
                                        endif;
                                        wp_reset_postdata(); 
                                    ?>

                                </div>
                            
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

                                                        <a href="<?php the_permalink(); ?>" class="post-featured-media">
                                                            <div class="image-wrapper">
                                                            <?php the_post_thumbnail( 'posts-featured-square-mobile' ); ?>
                                                            </div>
                                                        </a>

                                                        <div class="post-featured-content">
                                                            <div class="post-cats post-featured-category">
                                                                <div class="post-catetory">
                                                                    <a href="#" rel="category tag"><?php the_category(', '); ?></a>
                                                                </div>
                                                            </div>
                                                            <h3 class="post-featured-title">
                                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                            </h3>
                                                            <time class="post-footer" datetime="<?php the_time( 'Y-m-d' ); ?>">
                                                            
                                                                <?php 
                                                                    if( $has_estimated_time ) :
                                                                        ?>
                                                                            <span class="post-read-time"><?php echo $estimated_time; ?> <?php esc_html_e( 'min read', 'edigitalx' ); ?></span>
                                                                        <?php
                                                                    endif;
                                                                ?>
                                                                <span class="post-date"><?php echo get_the_time( 'M' ); ?> <?php echo get_the_time( 'd' ); ?>, <?php echo get_the_time( 'Y' ); ?></span>

                                                            </time>
                                                        </div>

                                                    </article><!-- .post .post-featured-link -->
                                    
                                                <?php
                                    
                                            endwhile;
                                        else:
                                        endif;
                                        wp_reset_postdata(); 
                                    ?>

                                </div>
                            
                        </div><!-- .posts-featured-sidebar  -->

                </div>
            </div>
        </section>


    </div>

<?php 
    get_footer();