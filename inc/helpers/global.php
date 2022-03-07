<?php
/** Template Global Definitions File
 * @package EDigitalX
 */
    /**
    echo 'gtd:  ' .get_template_directory(). '<br>';
    echo 'gtdu: ' .get_template_directory_uri(). '';
    die();
    */

    /** Archivo del Logo */
    if( ! defined( 'PATH_LOGO' ) ) {
        define( 'PATH_LOGO', get_template_directory_uri() .'/assets/build/images/svg/logo.svg' );
    }

    /** Mostrar nombre de archivos */
    if( ! defined( 'SHOW_FILE_NAME' ) ) {
        define( 'SHOW_FILE_NAME', true );
    }

    if( ! defined( 'THEME_DIR_PATH' ) ) {
        define(
            'THEME_DIR_PATH',
            untrailingslashit( get_template_directory() )     // WP Func: Elimina las barras inclinadas hacia adelante y hacia atrás si existen.
        );
    }

    if( ! defined( 'THEME_DIR_URI' ) ) {
        define(
            'THEME_DIR_URI',
            untrailingslashit( get_template_directory_uri() )     // WP Func: Elimina las barras inclinadas hacia adelante y hacia atrás si existen.
        );
    }

    /** Archivos CSS */
    if( ! defined( 'THEME_BUILD_CSS_DIR_PATH' ) ) {
        define(
            'THEME_BUILD_CSS_DIR_PATH',
            untrailingslashit( get_template_directory(). '/assets/build/css' )     // WP Func: Elimina las barras inclinadas hacia adelante y hacia atrás si existen.
        );
    }

    /** Archivos JavaScript */
    if( ! defined( 'THEME_BUILD_JS_URI' ) ) {
        define(
            'THEME_BUILD_JS_URI',
            untrailingslashit( get_template_directory_uri(). '/assets/build/js' )     // WP Func: Elimina las barras inclinadas hacia adelante y hacia atrás si existen.
        );
    }
    if( ! defined( 'THEME_BUILD_JS_DIR_PATH' ) ) {
        define(
            'THEME_BUILD_JS_DIR_PATH',
            untrailingslashit( get_template_directory(). '/assets/build/js' )     // WP Func: Elimina las barras inclinadas hacia adelante y hacia atrás si existen.
        );
    }