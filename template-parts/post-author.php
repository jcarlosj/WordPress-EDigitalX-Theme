<?php 
    /** Author Template File
 * @package EDigitalX
 */
?>

<?php
    global $post;

    // Valida si es una publicacion y tiene al menos un autor
    if( is_single() && isset( $post -> post_author ) ) :
        $post_author_id = $post -> post_author;

        $author_name = get_the_author_meta( 'display_name', $post_author_id ) 
            ?   get_the_author_meta( 'display_name', $post_author_id )
            :   get_the_author_meta( 'nickname', $post_author_id );

        if( ! empty( $author_name ) ) :
            $author_avatar = get_avatar( $post_author_id, $size='150' );
            $author_description = get_the_author_meta( 'user_description', $post_author_id );
            $author_website = get_the_author_meta( 'user_url', $post_author_id );
            $author_email = get_the_author_meta( 'user_email', $post_author_id );
            
            #echo '<pre>';   var_dump( $author_email );    echo '</pre>';

            ?>
                <section class="container card-author section">
                    <picture class="card-image card-image--horizontal">
                        <?php echo $author_avatar; ?>
                    </picture>
                    <article class="card-content">
                        <header class="card-author-header">
                            <h4><?php echo $author_name; ?></h4>
                        </header>
                        <div class="card-author-content"><?php echo $author_description; ?></div>
                        <footer class="card-author-footer">
                            <a href="<?php echo $author_website; ?>" class="card-web-site">
                                <span class="dashicons dashicons-admin-site"></span> 
                            </a> 
                           <a href="mailto:<?php echo $author_email; ?>?subject=<?php echo get_bloginfo(); ?>">
                                <span class="dashicons dashicons-email"></span>
                           </a> 
                        </footer>
                    </article>
                </section>
            <?php

        endif;
    endif;

?>