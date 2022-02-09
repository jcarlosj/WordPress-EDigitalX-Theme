<?php
/** Header Template File
 * @package EDigitalX
 */

    do_action( 'get_file_name', basename( __FILE__ ) );
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <div id="top">&nbsp;</div>
    <?php wp_body_open(); ?>

    <div id="theme-container" class="<?php echo ( is_user_logged_in() ) ? 'wp-is-user-logged-in' : ''; ?>">
        <header id="header" class="container-fluid<?php echo ( is_user_logged_in() ) ? ' wp-is-user-logged-in' : ''; ?>">

            <div class="site-branding">
                <div class="navbar-toggler">
                    <a href="#top" id="menu-icon" class="menu menu-icon">
                        <div class="menu-icon__bar-1"></div>
                        <div class="menu-icon__bar-2"></div>
                        <div class="menu-icon__bar-3"></div>
                    </a>
                </div>

                <?php wpex_logo(); ?>

            </div>
            <div class="site-navigation">

                <?php
                    wpex_logo();
                    if( has_nav_menu( 'edigitalx-header-menu' ) ):

                        $args = [
                            'theme_location'    => 'edigitalx-header-menu',
                            'container'         => 'nav',
                            'container_id'      => 'menu',
                            'container_class'   => 'menu menu-header not-display'
                        ];
                        wp_nav_menu( $args );
                ?>

                <?php endif; ?>

            </div>
            <div class="site-search">
                <a href="#top" id="search-icon" class="search-icon dashicons dashicons-search"></a>
                <!-- <span id="search-icon__close" class="dashicons dashicons-no-alt search-icon"></span> -->
            </div>

        </header>
        <?php get_search_form(); ?>
        <div id="background">&nbsp;</div>

