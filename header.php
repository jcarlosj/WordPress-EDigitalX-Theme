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
   
    <header id="header" class="container-fluid">

        <div class="site-branding">
        
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <img id="logo" src="<?php echo PATH_LOGO; ?>" alt="<?php echo get_bloginfo( 'name' ); ?>">
                <?php #echo get_bloginfo( 'name' ); ?>
            </a>
        
        </div>
        <div class="site-navigation">
        
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
            <span class="dashicons dashicons-search"></span>
        </div>
    
    </header>
