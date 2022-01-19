<?php
/** Entry Content Template File (Blog)
 * @package EDigitalX
 */
?>

<?php
    if( isset ( $args ) ) :
        //echo '<pre>';  print_r( $args );   echo '</pre>';
        $post_id = $args[ 'post_id' ];

        $entry_data = ( $args[ 'related_post' ] == 'categories' ) 
            ?   get_the_category( $post_id )                    //  Recupera categorias de una entrada
            :   ( ( $args[ 'related_post' ] == 'tags' )
                    ?   $tags = wp_get_post_tags( $post_id )    //  Recupera etiquetas de una entrada
                    :   null 
                ); 

    //echo '<pre>';  print_r( $entry_data );   echo '</pre>';

    if( $entry_data ) :
        $ids = [];

        foreach( $entry_data as $single_entry_data )
            $ids[] = $single_entry_data -> term_id;

        $query = new wp_query([
            'category__in'   => $ids,
            'post__not_in'  => [ $post_id ],
            'posts_per_page' => 3,
            'ignore_sticky_posts' => 1
        ]);
        
        ?>
            <div class="container">
                <?php
                    while( $query -> have_posts() ) :
                        $query -> the_post();
                        ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        <?php
                    endwhile;        
                ?>
            </div>
        <?php
    endif;
    wp_reset_query();
    
    endif;

?>