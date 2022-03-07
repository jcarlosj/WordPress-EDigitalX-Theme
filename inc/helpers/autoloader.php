<?php
/** Autoloader for Theme.
 * @package EDigitalX
 */

namespace THEME\Inc\Helpers;

/** Auto loader function.
 * @param string $resource Source namespace.
 * @return void
 */

function autoloader( $resource = '' ) {

	$resource_path  = false;
	$namespace_root = 'THEME\\';
	$resource       = trim( $resource, '\\' );

	if ( empty( $resource ) || strpos( $resource, '\\' ) === false || strpos( $resource, $namespace_root ) !== 0 ) {
		// No es nuestro espacio de nombres, rescatar.
		return;
	}

	// Elimina nuestro espacio de nombres raíz.
	$resource = str_replace( $namespace_root, '', $resource );

	$path = explode(
		'\\',
		str_replace( '_', '-', strtolower( $resource ) )
	);

	/** Es hora de determinar qué tipo de ruta de recursos es,
     * para que podamos deducir la ruta de archivo correcta para ella.
	 */
	if ( empty( $path[ 0 ] ) || empty( $path[ 1 ] ) ) {
		return;
	}

	// echo '<pre><b>autoloader - path</b><br />';
	// print_r( $path );
	// wp_die();

	$directory = '';
	$file_name = '';

	if ( 'inc' === $path[ 0 ] ) {

		switch ( $path[ 1 ] ) {
			case 'traits':
				$directory = 'traits';
				$file_name = sprintf( 'trait-%s', trim( strtolower( $path[ 2 ] ) ) );
				break;

			case 'widgets':
			case 'blocks': // phpcs:ignore PSR2.ControlStructures.SwitchDeclaration.TerminatingComment
				/** Si hay un nombre de clase proporcionado para un directorio específico, cárguelo.
                 * De lo contrario, busque en el directorio inc/.
				 */
				if ( ! empty( $path[ 2 ] ) ) {
					$directory = sprintf( 'classes/%s', $path[ 1 ] );
					$file_name = sprintf( 'class-%s', trim( strtolower( $path[ 2 ] ) ) );
					break;
				}
			default:
				$directory = 'classes';
				$file_name = sprintf( 'class-%s', trim( strtolower( $path[ 1 ] ) ) );
				break;
		}

		$resource_path = sprintf( '%s/inc/%s/%s.php', untrailingslashit( THEME_DIR_PATH ), $directory, $file_name );

	}

	/**
	 * Si $ is_valid_file tiene
     *      0 significa ruta válida o
     *      2 significa que la ruta del archivo contiene una ruta de unidad de Windows.
	 */
	$is_valid_file = validate_file( $resource_path );

	if ( ! empty( $resource_path ) && file_exists( $resource_path ) && ( 0 === $is_valid_file || 2 === $is_valid_file ) ) {
		// Ya nos estamos asegurando de que el archivo exista y sea válido.
		// echo '<pre><b>autoloader - require_once</b> <br />'. $resource_path;
		require_once( $resource_path ); // phpcs:ignore
	}

}

spl_autoload_register( '\THEME\Inc\Helpers\autoloader' );
