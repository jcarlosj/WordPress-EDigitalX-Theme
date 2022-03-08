<?php
/** Footer Template File
 * @package EDigitalX
 */

    do_action( 'get_file_name', basename( __FILE__ ) );
?>
    <a id="btn-telegram" target="_blank" href="https://t.me/explicaciondigital"></a>
    <a id="btn-go-up" href="#top">
        <span class="dashicons dashicons-arrow-up-alt"></span>
    </a>
    <footer class="site-footer">
        <div class="container">

            <div class="social-site-navigation">
                
                <p><?php _e( 'Follow us:', 'edigitalx' ); ?></p>
                <?php
                    if( has_nav_menu( 'edigitalx-social-footer-menu' ) ):

                        $args = [
                            'theme_location'    => 'edigitalx-social-footer-menu',
                            'container'         => 'nav',
                            'container_id'      => 'menu',
                            'container_class'   => 'menu menu-footer-social',
                            'menu_id'           => 'menu-social',
                            'menu_class'        => 'menu-social',
                            'link_before'       => '<span class="menu-social__link-text">',
                            'link_after'        => '</span>',
                        ];
                        wp_nav_menu( $args );
                    endif; 
                ?>

            </div>

            <div class="site-footer-navigation">

                <?php
                    if( has_nav_menu( 'edigitalx-footer-menu' ) ):

                        $args = [
                            'theme_location'    => 'edigitalx-footer-menu',
                            'container'         => 'nav',
                            'container_id'      => 'menu',
                            'container_class'   => 'menu menu-footer',
                            'menu_id'           => 'menu-footer',
                            'menu_class'        => 'menu-footer',
                        ];
                        wp_nav_menu( $args );
                    endif; 
                ?>

            </div>

            <div class="site-footer-copyright">
                <p class="copyright">
                    <span class="copyright__year"><?php echo date( 'Y' ); ?></span>
                    <span class="copyright__icon">&copy;</span>
                    <a class="copyright__website-name" href="<?php echo get_home_url(); ?>" class=""><?php echo get_bloginfo( 'name' ); ?></a>
                </p>
            </div>

        </div>
    </footer>

    </div>

    <?php wp_footer(); ?>

</body>
</html>