<?php
/** SideBar Template File
 * @package EDigitalX
 */
    do_action( 'get_file_name', basename( __FILE__ ) );
?>

<aside class="sidebar widgets">
    <?php dynamic_sidebar( 'primary_sidebar_widget' ); ?>
</aside>