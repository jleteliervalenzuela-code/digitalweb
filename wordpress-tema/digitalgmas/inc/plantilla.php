<?php
/**
 * Funciones que usan las plantillas: íconos, imágenes, botones y bloques
 * que se repiten en varias páginas (el equivalente a los «parciales»).
 *
 * @package digitalgmas
 */

defined( 'ABSPATH' ) || exit;

/**
 * Ícono SVG en línea desde /iconos (Lucide, licencia ISC; WhatsApp de Simple Icons, CC0).
 */
function dgm_icono( $nombre, $clase = 'icono' ) {
	static $cache = array();
	if ( ! isset( $cache[ $nombre ] ) ) {
		$archivo          = DGM_DIR . '/iconos/' . sanitize_file_name( $nombre ) . '.svg';
		$cache[ $nombre ] = file_exists( $archivo ) ? file_get_contents( $archivo ) : ''; // phpcs:ignore
	}
	return str_replace( '<svg', '<svg class="' . esc_attr( $clase ) . '"', $cache[ $nombre ] );
}

/**
 * Imagen responsiva de la biblioteca de medios.
 *
 * @param int    $id     ID del adjunto.
 * @param string $sizes  Atributo sizes.
 * @param array  $op     'prioridad' => true (carga inmediata), 'alt' => texto (null usa el de la biblioteca), 'tamano' => tamaño de WordPress.
 */
function dgm_imagen( $id, $sizes = '100vw', $op = array() ) {
	$id = absint( $id );
	if ( ! $id ) {
		return '';
	}
	$atributos = array(
		'sizes'    => $sizes,
		'loading'  => ! empty( $op['prioridad'] ) ? 'eager' : 'lazy',
		'decoding' => 'async',
	);
	if ( ! empty( $op['prioridad'] ) ) {
		$atributos['fetchpriority'] = 'high';
	}
	if ( array_key_exists( 'alt', $op ) && null !== $op['alt'] ) {
		$atributos['alt'] = $op['alt'];
	}
	return wp_get_attachment_image( $id, $op['tamano'] ?? 'large', false, $atributos );
}

/** Dirección de WhatsApp con el mensaje inicial. */
function dgm_url_whatsapp() {
	return 'https://wa.me/' . preg_replace( '/\D/', '', dgm_opcion( 'whatsapp' ) ) . '?text=' . rawurlencode( dgm_opcion( 'whatsapp_mensaje' ) );
}

/** Teléfono para enlaces tel: (sin espacios). */
function dgm_tel() {
	return preg_replace( '/[^\d+]/', '', dgm_opcion( 'telefono' ) );
}

/** Botón secundario de WhatsApp. */
function dgm_boton_whatsapp( $clase = 'boton--secundario' ) {
	return '<a class="boton ' . esc_attr( $clase ) . '" href="' . esc_url( dgm_url_whatsapp() ) . '" target="_blank" rel="noopener">'
		. dgm_icono( 'whatsapp', 'icono icono-wa' ) . 'Escribir por WhatsApp<span class="solo-lectores"> (se abre en una pestaña nueva)</span></a>';
}

/** Dirección de la página de contacto, con servicio preseleccionado opcional. */
function dgm_url_contacto( $servicio = '' ) {
	$url = home_url( '/contacto/' );
	return $servicio ? add_query_arg( 'servicio', $servicio, $url ) : $url;
}

/** Recuadro [PENDIENTE] (solo si la opción está activa). */
function dgm_pendiente( $que_falta ) {
	if ( ! dgm_opcion( 'mostrar_pendiente' ) ) {
		return '';
	}
	return '<div class="pendiente" role="note"><strong>[PENDIENTE]</strong> ' . esc_html( $que_falta ) . '</div>';
}

/** Migas de pan. $ruta = [ [texto, url], ..., [texto actual] ] */
function dgm_migas( $ruta ) {
	$html = '<div class="contenedor"><nav class="migas" aria-label="Ruta de navegación"><ol><li><a href="' . esc_url( home_url( '/' ) ) . '">Inicio</a></li>';
	foreach ( $ruta as $paso ) {
		$html .= isset( $paso[1] )
			? '<li><a href="' . esc_url( $paso[1] ) . '">' . esc_html( $paso[0] ) . '</a></li>'
			: '<li aria-current="page">' . esc_html( $paso[0] ) . '</li>';
	}
	return $html . '</ol></nav></div>';
}

/** Tarjeta de un servicio. */
function dgm_tarjeta( $post ) {
	$img   = get_post_thumbnail_id( $post ) ?: (int) get_post_meta( $post->ID, 'dgm_franja', true );
	$bajada = get_post_meta( $post->ID, 'dgm_bajada', true );
	ob_start();
	?>
	<article class="tarjeta">
		<div class="tarjeta__imagen"><?php echo dgm_imagen( $img, '(min-width: 64rem) 380px, (min-width: 40rem) 45vw, 92vw', array( 'alt' => '', 'tamano' => 'medium_large' ) ); // phpcs:ignore ?></div>
		<div class="tarjeta__cuerpo">
			<h3><a href="<?php echo esc_url( get_permalink( $post ) ); ?>"><?php echo esc_html( get_the_title( $post ) ); ?></a></h3>
			<?php if ( $bajada ) : ?><p><?php echo esc_html( $bajada ); ?></p><?php endif; ?>
			<span class="enlace-flecha" aria-hidden="true">Ver servicio <?php echo dgm_icono( 'arrow-right' ); // phpcs:ignore ?></span>
		</div>
	</article>
	<?php
	return ob_get_clean();
}

/** Muro de logos de clientes. */
function dgm_logos() {
	$html = '<ul class="logos" aria-label="Instituciones clientes">';
	foreach ( dgm_clientes() as $c ) {
		$html .= '<li>' . dgm_imagen( get_post_thumbnail_id( $c ), '(min-width: 64rem) 280px, (min-width: 40rem) 30vw, 45vw', array( 'alt' => get_the_title( $c ), 'tamano' => 'medium_large' ) ) . '</li>';
	}
	return $html . '</ul>';
}

/** Bloque final «Hablemos de tu biblioteca». */
function dgm_cierre( $servicio = '' ) {
	$correo = dgm_opcion( 'correo' );
	ob_start();
	?>
	<section class="seccion oscuro cierre" aria-labelledby="titulo-cierre">
		<div class="contenedor revelar">
			<p class="antetitulo">Contacto</p>
			<h2 id="titulo-cierre">Hablemos de tu biblioteca</h2>
			<div class="acciones">
				<a class="boton boton--claro" href="<?php echo esc_url( dgm_url_contacto( $servicio ) ); ?>">Solicitar cotización</a>
				<?php echo dgm_boton_whatsapp( 'boton--contorno-claro' ); // phpcs:ignore ?>
			</div>
			<div class="cierre__datos">
				<a href="mailto:<?php echo esc_attr( $correo ); ?>"><?php echo dgm_icono( 'mail' ) . esc_html( $correo ); // phpcs:ignore ?></a>
				<a href="tel:<?php echo esc_attr( dgm_tel() ); ?>"><?php echo dgm_icono( 'phone' ) . esc_html( dgm_opcion( 'telefono' ) ); // phpcs:ignore ?></a>
			</div>
		</div>
	</section>
	<?php
	return ob_get_clean();
}

/** Párrafos de un texto de varias líneas (opciones del Personalizador). */
function dgm_parrafos( $texto ) {
	return wpautop( esc_html( $texto ) );
}
