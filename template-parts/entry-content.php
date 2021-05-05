<?php
/** Entry Content Template File (Blog)
 * @package EDigitalX
 */
?>          

<?php if ( is_front_page() ) : ?>
  
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

<?php elseif( is_page() || is_single() ) : ?>

    <section class="section">
        <main class="main-content">
            <?php the_content(); ?>
        </main>
    </section>

<?php elseif( is_home() ) : ?>

    <p class="entry-excerpt">
        <?php if( has_excerpt() ): ?>
            <?php echo get_the_excerpt(); ?>
        <?php else: ?>
            <?php echo wp_trim_words( get_the_content(), 18, '..' ); ?>
        <?php endif; ?>
    </p>

<?php endif; ?>

