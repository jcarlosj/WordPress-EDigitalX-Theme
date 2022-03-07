<?php
/** Entry Date and Read Time Template File (Blog)
 * @package EDigitalX
 */
?>

<?php
    // if( isset ( $args ) ) :
    //      echo '<pre>';  var_dump( $args );   echo '</pre>';
    // endif;
?>


<?php if( is_front_page() || is_home() || is_archive() || is_search() ) : ?>

    <footer class="entry__footer">
        <time class="entry__time" datetime="<?php the_time( 'Y-m-d' ); ?>">

        <span class="<?php echo $args[ 'is_entry_featured' ] ? 'entry-featured__date' : 'entry__date'; ?>"><?php echo get_the_time( 'M' ); ?> <?php echo get_the_time( 'd' ); ?>, <?php echo get_the_time( 'Y' ); ?></span>
            <?php
                if( $args[ 'has_estimated_time' ] ) :
                    ?>
                        <span class="<?php echo $args[ 'is_entry_featured' ] ? 'entry-featured__time-read' : 'entry__time-read'; ?>">
                            <span class="dashicons dashicons-clock"></span>
                            <?php echo $args[ 'estimated_time' ]; ?>
                            <?php esc_html_e( 'min read', 'edigitalx' ); ?>
                        </span>
                    <?php
                endif;
            ?>

        </time>
    </footer>

<?php elseif( is_single() ) : ?>
    <div class="entry__info">
        
        <p class="entry__author entry__author--<?php echo $args[ 'color_entry_author' ]; ?>">
            <?php esc_html_e( 'Written by:', 'edigitalx' ); ?> <?php the_author_posts_link(); ?>
        </p>

        <time class="entry__time entry__time--<?php echo $args[ 'color_entry_author' ]; ?>" datetime="<?php the_time( 'Y-m-d' ); ?>">

            <span class="<?php echo $args[ 'is_entry_featured' ] ? 'entry-featured__date' : 'entry__date'; ?>"><?php echo get_the_time( 'M' ); ?> <?php echo get_the_time( 'd' ); ?>, <?php echo get_the_time( 'Y' ); ?></span>
            <?php
                if( $args[ 'has_estimated_time' ] ) :
                    ?>
                        <span class="<?php echo $args[ 'is_entry_featured' ] ? 'entry-featured__time-read' : 'entry__time-read'; ?>">
                            <span class="dashicons dashicons-clock"></span>
                            <?php echo $args[ 'estimated_time' ]; ?>
                            <?php esc_html_e( 'min read', 'edigitalx' ); ?>
                        </span>
                    <?php
                endif;
            ?>

        </time>

        <span class="entry__categories">
            <?php the_category( ' ' ); ?>
        </span>
    </div>

<?php endif; ?>