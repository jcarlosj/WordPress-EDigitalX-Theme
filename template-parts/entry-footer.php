<?php
/** Entry Footer Template File (Blog)
 * @package EDigitalX
 */
?>

<?php
    // if( isset ( $args ) ) :
    //     echo '<pre>';  var_dump( $args );   echo '</pre>';
    // endif;
?>

<?php if( is_front_page() || is_home() || is_archive() || is_search() ) : ?>

    <?php get_template_part( 'template-parts/entry', 'details', $args ); ?>

<?php elseif( is_page() || is_single() ) : ?>

<?php endif; ?>