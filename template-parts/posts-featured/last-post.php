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