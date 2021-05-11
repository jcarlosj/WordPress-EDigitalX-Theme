<?php 
    // if( isset ( $args ) ) :
    //     echo '<pre>';  var_dump( $args );   echo '</pre>';
    // endif;
?>

<?php if( is_front_page() || is_home() ) : ?>

    <!-- <div class="entry__thumbnail entry__thumbnail--position"> -->
    <div class="entry__thumbnail <?php echo $args[ 'is_entry_featured' ] ? 'entry-featured__thumbnail--position' : 'entry__thumbnail--position'; ?>">

        <a class="entry__thumbnail-link" href="<?php the_permalink(); ?>">
            <?php 

                if( $args[ 'is_entry_featured' ] ) {
                        
                    the_post_thumbnail( 
                        'entry-square', 
                        [
                            'class' => 'entry-featured__image entry-featured__image--rounded'
                        ]
                    ); 

                }
                else {

                    the_post_thumbnail( 
                        'entry-landscape', 
                        [
                            'class' => 'entry__image entry__image--rounded'
                        ]
                    ); 

                }

            ?>
        </a>

    </div>

<?php elseif( is_page() || is_single() ) : ?>

<?php endif; ?>