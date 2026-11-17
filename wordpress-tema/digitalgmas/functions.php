<?php
/**
 * Tema Digital G+ · Punto de entrada.
 *
 * Organización:
 *   inc/opciones.php       Opciones del sitio (Apariencia → Personalizar → Digital G+)
 *   inc/tipos.php          Tipos de contenido: Servicio, Cliente y la taxonomía Línea, con sus campos
 *   inc/plantilla.php      Funciones que usan las plantillas (íconos, imágenes, botones, bloques)
 *   inc/cabeza.php         <head>: estilos, scripts, SEO, Open Graph, Google Tag Manager
 *   inc/redirecciones.php  Redirecciones 301 de direcciones antiguas
 *   inc/importar.php       Importador del contenido inicial (Digital G+ → Importar contenido)
 *
 * @package digitalgmas
 */

defined( 'ABSPATH' ) || exit;

define( 'DGM_VERSION', '1.0.0' );
define( 'DGM_DIR', get_template_directory() );
define( 'DGM_URI', get_template_directory_uri() );

require DGM_DIR . '/inc/opciones.php';
require DGM_DIR . '/inc/tipos.php';
require DGM_DIR . '/inc/plantilla.php';
require DGM_DIR . '/inc/cabeza.php';
require DGM_DIR . '/inc/redirecciones.php';
require DGM_DIR . '/inc/importar.php';

/**
 * Funciones básicas del tema.
 */
add_action( 'after_setup_theme', function () {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'responsive-embeds' );
	// Imagen ancha para cabeceras de servicio (las franjas de 1900 px)
	add_image_size( 'dgm-franja', 1900, 300, true );
} );

/**
 * Imágenes nuevas en WebP cuando el servidor lo permite (más livianas).
 * Si el servidor no soporta WebP, WordPress sigue usando JPEG/PNG.
 */
add_filter( 'image_editor_output_format', function ( $formatos ) {
	if ( wp_image_editor_supports( array( 'mime_type' => 'image/webp' ) ) ) {
		$formatos['image/jpeg'] = 'image/webp';
		$formatos['image/png']  = 'image/webp';
	}
	return $formatos;
} );

/**
 * El sitio no tiene blog ni comentarios: se ocultan esos menús del panel
 * para que sea más simple de usar. (No se borra nada; se puede revertir
 * quitando estas líneas.)
 */
add_action( 'admin_menu', function () {
	remove_menu_page( 'edit.php' );
	remove_menu_page( 'edit-comments.php' );
} );
add_filter( 'comments_open', '__return_false' );
add_filter( 'pings_open', '__return_false' );
