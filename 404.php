<?php
/** 404 Template File
 * @package EDigitalX
 */

    get_header();
    do_action( 'get_file_name', basename( __FILE__ ) );
?>

    <section class="posts-featured">
        <div class="container">
            404
        </div>
    </section>

<?php
    get_footer();