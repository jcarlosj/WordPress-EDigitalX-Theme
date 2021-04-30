<?php
/** Front-Page Template File 
 * @package EDigitalX
 */

    get_header();
    do_action( 'get_file_name', basename( __FILE__ ) );
?>
   
    <div id="site-container">

        <? 
            query_posts('meta_key=post_views_count&orderby=meta_value_num&order=DESC'); 
        ?>

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

        <?php 
            
            $args = array(
                'posts_per_page' => 5,
                'meta_key' => 'featured_post',
                'meta_value' => 'yes'
            );

            $featured_post = new WP_Query( $args );

            # echo '<pre>';   var_dump( $featured_post );     echo '</pre>';   
        ?>
            <div class="lista-destacados">
                <h2>Publicaciones Destacadas</h2>
                
                    <?php 
                        if ( $featured_post -> have_posts() ) : 
                            while( $featured_post -> have_posts() ) : 
                                $featured_post -> the_post(); 

                                ?>
                                    
                                    <h3>
                                        <a href="<?php the_permalink(); ?>"> 
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>
                                    <p class="detalles">De <a href="<?php the_author_posts() ?>"><?php the_author(); ?> </a> / <?php echo get_the_date('F j, Y'); ?> / In <?php the_category(', '); ?></p>
                    
                                <?php
                    
                            endwhile;
                        else:
                        endif;
                        wp_reset_postdata(); 
                    ?>
                
            </div>

    </div>

<?php 
    get_footer();