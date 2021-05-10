<?php
/** Entry Footer Template File (Blog)
 * @package EDigitalX
 */
?>            

<footer class="entry__footer">

    <time class="entry__time" datetime="<?php the_time( 'Y-m-d' ); ?>">

        <?php 
            if( $has_estimated_time ) :
                ?>
                    <span class="entry__time-read"><?php echo $estimated_time; ?> <?php esc_html_e( 'min read', 'edigitalx' ); ?></span>
                <?php
            endif;
        ?>
        <span class="entry__date"><?php echo get_the_time( 'M' ); ?> <?php echo get_the_time( 'd' ); ?>, <?php echo get_the_time( 'Y' ); ?></span>

    </time>
    
</footer>