<?php
/** Publish posts related to the content template file by content or tag (Blog)
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

        #echo '<pre>';  print_r( $ids );   echo '</pre>';

        $query_filter = [
            'post__not_in'  => [ $post_id ],
            'posts_per_page' => 3,
            'ignore_sticky_posts' => 1
        ];

        if( $args[ 'related_post' ] == 'categories' ) :
            $query_filter[ 'category__in' ] = $ids; 

        elseif( $args[ 'related_post' ] == 'tags' ) :
            $query_filter[ 'tag__in' ] = $ids;

        endif;

        $query = new wp_query( $query_filter );

        #echo '<pre>';  print_r( $query -> found_posts );   echo '</pre>';
        
        if( $query -> found_posts > 0 ) :

            ?>
                <div class="container">
                    <h3 class="title-related-posts"><?php _e( 'Related posts', 'edigitalx' ); ?></h3>

                    <?php
                        while( $query -> have_posts() ) :
                            $query -> the_post();
                            ?>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                                <span class="entry__categories">
                                    <?php the_category( ' ' ); ?>
                                </span>
                                <span class="entry__categories">
                                    <?php the_tags( ' ' ); ?>
                                </span>
                            <?php
                        endwhile;        
                    ?>
                </div>
            <?php

        endif;
    endif;
    wp_reset_query();
    
    endif;

?>