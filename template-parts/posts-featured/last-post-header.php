<?php if( is_front_page() ) : ?>

    <div class="post-media">
        <a href="<?php echo get_permalink( $recent_posts[ 0 ][ 'ID' ] ); ?>" class="thumbnail-link">    
            <?php echo get_the_post_thumbnail( $recent_posts[ 0 ][ 'ID' ], 'posts-featured-landscape-mobile' ); ?>
        </a>
    </div>

<?php elseif( is_page() || is_single() ): ?>

<?php elseif( is_home() ) : ?>

<?php endif; ?>