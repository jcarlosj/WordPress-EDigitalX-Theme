<?php
/** Template Part: Display message 'Posts cannot be found'
 * @package Aquila
 */
?>

<section class="no-result not-found">

    <header class="page-header">
        <h1 class="page-title">
            <?php esc_html_e( 'Nothing Found', 'aquila' ); ?>
        </h1>
    </header>

    <div class="page-content">
        <?php 
            /** Verifica si el usuario actual puede realizar publicaciones */
            if( is_home() && current_user_can( 'publish_posts' ) ) {
                ?>
                    <p>
                        <?php 
                            printf( 
                                //  Filtra el contenido de texto y elimina el HTML no permitido.
                                wp_kses(
                                    __( 'Ready to publish your first post? <a href="%s">Get started here</a>', 'aquila' ),
                                    [
                                        'a' => [
                                            'href' => []
                                        ]
                                    ]
                                ),
                                esc_url( admin_url( 'post-new.php' ) )       
                            );
                        ?>
                    </p>
                <?php
            }
            elseif( is_search() ) {
                ?>
                    <p><?php esc_html_e( 'Sorry but nothing matched your search item. Please try again with some different keywords', 'aquila' ); ?></p>
                <?php 
                    get_search_form();  
            }
            else {
                ?>
                    <p><?php esc_html_e( 'It seems that we cannot find what you are lookin for. Perhaps search cam help.', 'aquila' ); ?></p>
                <?php 
                    get_search_form(); 
            }
        ?>
    </div>

</section>