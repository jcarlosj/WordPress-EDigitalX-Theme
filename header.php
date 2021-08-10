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

    <?php wp_body_open(); ?>

    <div id="theme-container">
    
    <header id="header" class="container-fluid">

        <div class="site-branding">
            <div class="navbar-toggler">
                <div id="menu-icon" class="menu menu-icon">
                    <div class="menu-icon__bar-1"></div>
                    <div class="menu-icon__bar-2"></div>
                    <div class="menu-icon__bar-3"></div>
                </div>
            </div>

            <?php
                if ( function_exists( 'the_custom_logo' ) ) :
                    the_custom_logo();
                endif;
            ?>

        </div>
        <div class="site-navigation">

            <?php
                if ( function_exists( 'the_custom_logo' ) ) :
                    the_custom_logo();
                endif;
            ?>

            <?php if( has_nav_menu( 'edigitalx-header-menu' ) ):

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
            <span id="search-icon" class="search-icon dashicons dashicons-search"></span>
            <!-- <span id="search-icon__close" class="dashicons dashicons-no-alt search-icon"></span> -->
            <?php get_search_form(); ?>
        </div>

    </header>
    <div id="top">&nbsp;</div>

