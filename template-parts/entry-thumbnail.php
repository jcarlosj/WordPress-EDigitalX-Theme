<?php
    // if( isset ( $args ) ) :
    //     echo '<pre>';  var_dump( $args );   echo '</pre>';
    // endif;
?>

<?php if( is_front_page() || is_home() || is_archive() || is_search() ) : ?>

    <?php
        if( has_post_thumbnail( get_the_ID() ) ) :

            the_post_thumbnail(
                $args[ 'image_size' ],
                [
                    'class' => 'entry-featured__image entry-featured__image--rounded'
                ]
            );

        else :
            has_no_featured_image();
        endif;

?>

<?php elseif( is_page() || is_single() ) : ?>

<?php endif; ?>