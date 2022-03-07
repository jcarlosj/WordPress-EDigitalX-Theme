<?php
/** Custom Queries
 * @package EDigitalX
 */

namespace THEME\Inc;

use THEME\Inc\Traits\Singleton;

class Queries {
    use Singleton;

    const OFFSET_HOME = 1;          # Define nuevo desplazamiento: Excluye N publicaciones (a partir de la última realizada)

    protected function __construct() {
        // wp_die( 'Class Queries' );

        //  Cargamos Clases.
        $this -> setup_hooks();
    }

    protected function setup_hooks() {

        /** Actions */
        //wp_die( 'Class Queries setup_hooks' );
        add_action( 'found_posts', [ $this, 'home_adjust_offset_pagination' ], 1, 2 );
    }

    /** Ajusta paginacion al desplazamiento producido por un cambio en el query */
    public function home_adjust_offset_pagination( $found_posts, $query ) {

        # Asegúrese de que estamos modificando el objeto de consulta correcto ...
        if ( $query -> is_home() ) {

            #Reducir el recuento de publicaciones encontradas de WordPress por el desplazamiento ...
            return $found_posts - self :: OFFSET_HOME;
        }

        return $found_posts;
    }

    public function home_offset_exclude_latest_post() {
        $post_per_page = get_option( 'posts_per_page' );                        #   Obtiene valor predeterminado de publicaciones por pagina                                                        #   Desplazamiendo para excluir la última publicación
        $paged = get_query_var( 'paged', 1 );                                   #   Obtenemos la pagina actual

        # Verifica si es un resultado paginado.
        if( is_paged() ) :
            # No es la primera pagina, es para un resultado paginado.

            # Determine manualmente el desplazamiento de la consulta de la página (desplazamiento + página actual (menos uno) x publicaciones por página)
            $page_offset = self :: OFFSET_HOME + ( ( $paged - 1 ) * $post_per_page );

            #echo "Paginado: $page_offset";

            # Aplicar ajustar desplazamiento de página
            return [
                'offset' => $page_offset,
                'paged' => $paged
            ];
        else :
            #echo "Pagina principal: self :: OFFSET_HOME";

            # Ésta es la primera página. Solo usa el desplazamiento.
            return [
                'offset' => self :: OFFSET_HOME,            # Excluye N publicaciones (a partir de la última realizada)
                'paged' => $paged
            ];
        endif;
    }

}