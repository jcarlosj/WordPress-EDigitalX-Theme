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

<?php #get_template( 'template-parts/entry', 'read-time', $args ); ?>

<?php if( is_front_page() || is_home() || is_archive() ) : ?>
    
    <?php get_template_part( 'template-parts/entry', 'details', $args ); ?>

<?php elseif( is_page() || is_single() ) : ?>

<?php endif; ?>