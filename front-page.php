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
                <div class="row posts-featured-row">

                    <?php 
                        $args = array(
                            'numberposts' => 1,         // Number of recent posts thumbnails to display
                            'post_status' => 'publish'  // Show only the published posts
                        );

                        $recent_posts = wp_get_recent_posts( $args );

                        // echo '<pre>';   var_dump( $recent_posts );     echo '</pre>';  

                        foreach( $recent_posts as $post_item ) : 
                    ?>
                    
                        <article id="post-<?php $recent_posts[ 0 ][ 'ID' ]; ?>" class="post-featured-<?php echo $recent_posts[ 0 ][ 'post_title' ]; ?>">
                            <div class="post-inner flex flex-column">

                                <a href="<?php echo get_permalink( $recent_posts[ 0 ][ 'ID' ] ); ?>" class="post-media">
                                    <div class="image-wrapper has-aspect-ratio has-aspect-ratio-16-9">
                                        <?php echo get_the_post_thumbnail( $recent_posts[ 0 ][ 'ID' ], 'posts-featured-landscape-mobile' ); ?>
                                    </div>
                                </a>
                                
                                <div class="post-content flex-grow">
                                    <div class="post-cats">
                                        <div class="post-catetory">
                                            <a href="https://demo.apalodi.com/kutak/category/lifestyle/?header=classic" rel="category tag">Lifestyle</a>
                                        </div>
                                    </div>
                                    <a href="<?php echo get_permalink( $recent_posts[ 0 ][ 'ID' ] ); ?>">
                                    <h2 class="post-title"><?php echo $recent_posts[ 0 ][ 'post_title' ]; ?></h2>
                                    <p>Get yourself organised and get more things done</p>
                                    </a>
                                </div>

                                <div class="post-footer">
                                    <span class="post-read-time">3 min read</span>
                                    <span class="post-date">October 4, 2018</span>
                                </div>
                            </div>

                        </article><!-- #post-## -->
                            
                    <?php endforeach; ?>


                    <div class="posts-featured-sidebar column">

                            <div class="featured-tabs">

                                <button class="featured-tab is-active" data-id="#popular-posts">Trending</button>
                                <button class="featured-tab" data-id="#recommended-posts">Recommended</button>
                                                                
                            </div>
                        
                            <div id="popular-posts" class="featured-panel">

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

                                            ?>

                                                <article class="post post-featured-link">

                                                    <a href="<?php the_permalink(); ?>" class="post-featured-media">
                                                        <div class="image-wrapper">
                                                            <?php the_post_thumbnail( 'posts-featured-square-mobile' ); ?>
                                                        </div>
                                                    </a>

                                                    <div class="post-featured-content flex-grow">
                                                        <div class="post-cats post-featured-category">
                                                            <div class="post-catetory">
                                                                <a href="#" rel="category tag"><?php the_category(', '); ?></a>
                                                            </div>
                                                        </div>
                                                        <h3 class="post-featured-title">
                                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                        </h3>
                                                        <div class="post-footer post-featured-footer">
                                                            <span class="post-read-time">3 min read</span>
                                                            <span class="post-date"><?php echo get_the_date('F j, Y'); ?></span>
                                                        </div>
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

                                            ?>
                                                
                                                <article class="post post-featured-link">

                                                    <a href="<?php the_permalink(); ?>" class="post-featured-media">
                                                        <div class="image-wrapper">
                                                        <?php the_post_thumbnail( 'posts-featured-square-mobile' ); ?>
                                                        </div>
                                                    </a>

                                                    <div class="post-featured-content flex-grow">
                                                        <div class="post-cats post-featured-category">
                                                            <div class="post-catetory">
                                                                <a href="#" rel="category tag"><?php the_category(', '); ?></a>
                                                            </div>
                                                        </div>
                                                        <h3 class="post-featured-title">
                                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                        </h3>
                                                        <div class="post-footer post-featured-footer">
                                                            <span class="post-read-time">3 min read</span>
                                                            <span class="post-date"><?php echo get_the_date('F j, Y'); ?></span>
                                                        </div>
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