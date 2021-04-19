<?php
/** Trait Singleton for Theme.
 * @package Aquila
 */

namespace THEME\Inc\Traits;

trait Singleton {

    public function __construct() {}

    public function __clone() {}

    final public static function get_instance() {
        static $instance = [];

        $called_class = get_called_class();

        /** Vefirica que no existe instancia de la clase en el Array */
        if( ! isset( $instance[ $called_class ] ) ) {
            // echo '<pre><b>Trait Singleton - Class</b> <br />', $called_class;
            $instance[ $called_class ] = new $called_class();   //  Crea la instancia de la clase obtenida en caso no no existir

            do_action( sprintf( 'theme_theme_singleton_init%s', $called_class ) );     //  Ejecuta funciones conectadas al Hook
                                                                                        //  phpcs:ignore WordPress.NamingConventions.ValidHookName.UseUnderscores
        }

        return $instance[ $called_class ];
    }

}