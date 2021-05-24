<?php
/** 404 Template File 
 * @package EDigitalX
 */

    get_header();
    do_action( 'get_file_name', basename( __FILE__ ) );
?>
   
    <div id="site-container" class="404">

        <section class="posts-featured">
            <div class="container">
                404
            </div>
        </section>

    </div>

<?php 
    get_footer();