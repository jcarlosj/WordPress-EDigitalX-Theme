<?php
/** Entry Footer Template File (Blog)
 * @package EDigitalX
 */
?>            

<footer class="entry-footer">

    <time class="entry-time" datetime="<?php the_time( 'Y-m-d' ); ?>">
            
        <?php 
            if( $has_estimated_time ) :
                ?>
                    <span class="post-read-time"><?php echo $estimated_time; ?> <?php esc_html_e( 'min read', 'edigitalx' ); ?></span>
                <?php
            endif;
        ?>
        <span class="entry-date"><?php echo get_the_time( 'M' ); ?> <?php echo get_the_time( 'd' ); ?>, <?php echo get_the_time( 'Y' ); ?></span>

    </time>

</footer>