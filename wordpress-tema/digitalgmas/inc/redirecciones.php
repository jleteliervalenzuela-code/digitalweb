<?php
/**
 * Redirecciones permanentes (301) de direcciones del sitio anterior que
 * ya no existen. Las páginas y servicios conservan sus direcciones, así
 * que solo hacen falta estas.
 *
 * Para agregar una: 'dirección antigua/' => 'dirección nueva/'.
 *
 * @package digitalgmas
 */

defined( 'ABSPATH' ) || exit;

function dgm_redirecciones() {
	return array(
		'servicio/'                              => 'nuestros-servicios/',
		'servicio/page/2/'                       => 'nuestros-servicios/',
		'servicio/biblioteca-agentica/'          => 'servicio/agente-biblioteca/',
		'servicio/buscador-de-bibliografias/'    => 'servicio/buscador-bibliografias/',
		'category/digitalizacion/'               => 'nuestros-servicios/#digitalizacion',
		'category/productos-bibliotheca/'        => 'nuestros-servicios/#productos-bibliotheca',
		'category/plataformas-y-productos-con-ia-inteligencia-artificial/' => 'nuestros-servicios/#plataformas-ia',
		'pagina-de-ejemplo/'                     => '',
		'super-simple-slider/slider-escritorio/' => '',
	);
}

add_action( 'template_redirect', function () {
	$ruta_sitio = trailingslashit( (string) wp_parse_url( home_url( '/' ), PHP_URL_PATH ) );
	$pedida     = (string) wp_parse_url( isset( $_SERVER['REQUEST_URI'] ) ? wp_unslash( $_SERVER['REQUEST_URI'] ) : '', PHP_URL_PATH ); // phpcs:ignore
	$relativa   = ltrim( substr( $pedida, strlen( $ruta_sitio ) - 1 ), '/' );
	$relativa   = trailingslashit( $relativa );
	$mapa       = dgm_redirecciones();
	if ( isset( $mapa[ $relativa ] ) ) {
		wp_safe_redirect( home_url( '/' . $mapa[ $relativa ] ), 301, 'Digital G+' );
		exit;
	}
}, 1 );
