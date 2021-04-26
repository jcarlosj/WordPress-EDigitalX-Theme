<?php
/** Front-Page Template File 
 * @package EDigitalX
 */

    get_header();
    do_action( 'get_file_name', basename( __FILE__ ) );
?>
   
    <div id="site-container">

        <?php 
            if ( have_posts() ) : 
                // Loop WP
                while ( have_posts() ) : the_post(); 
                    //get_template_part( 'template-parts/entry', 'header' );
                    get_template_part( 'template-parts/entry', 'content' );
                endwhile; 

            else :
                get_template_part( 'template-parts/entry-none' );
            endif; 
            
            //  Solo Debugging
            //  get_template_part( 'template-parts/entry-none' ); 
        ?> 

    </div>

<?php 
    get_footer();