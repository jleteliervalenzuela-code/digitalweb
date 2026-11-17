<?php
/**
 * Opciones del sitio en Apariencia → Personalizar → «Digital G+».
 * Aquí se editan los textos de la portada, los datos de contacto,
 * Google Tag Manager y el formulario.
 *
 * @package digitalgmas
 */

defined( 'ABSPATH' ) || exit;

/**
 * Valores por defecto (los mismos del sitio anterior).
 */
function dgm_opciones_por_defecto() {
	return array(
		'descripcion'       => 'Digital G+ es una consultora de bibliotecarios y documentalistas. Digitalización, productos Bibliotheca y plataformas con IA para bibliotecas e instituciones educativas en Chile.',
		'antetitulo'        => 'Partner Bibliotheca',
		'titulo'            => 'Consultoría, tecnología y digitalización para bibliotecas',
		'bajada'            => 'Somos una empresa de consultoría formada por bibliotecarios documentalistas y distribuidor de Bibliotheca en Chile.',
		'hero_imagen'       => 0,
		'partner_titulo'    => 'Somos distribuidor de Bibliotheca en Chile',
		'partner_foto_1'    => 0,
		'partner_foto_2'    => 0,
		'nosotros_titulo'   => 'Bibliotecarios documentalistas al servicio de tu biblioteca',
		'nosotros_bajada'   => 'Nuestro principal objetivo es proporcionar servicios de calidad que contribuyan a mejorar la gestión y la experiencia de sus usuarios.',
		'nosotros_imagen'   => 0,
		'clientes_titulo'   => 'Ellos confían en nosotros',
		'correo'            => 'contacto@digitalgmas.cl',
		'telefono'          => '+56 9 7389 1319',
		'whatsapp'          => '56973891319',
		'whatsapp_mensaje'  => 'Hola, quiero solicitar una cotización a Digital G+.',
		'direccion'         => '',
		'horario'           => '',
		'mision'            => '',
		'vision'            => '',
		'equipo'            => '',
		'gtm'               => 'GTM-PCLFRV6',
		'form_accion'       => 'https://formsubmit.co/contacto@digitalgmas.cl',
		'form_asunto'       => 'Nueva solicitud desde digitalgmas.cl',
		'mostrar_pendiente' => true,
	);
}

/**
 * Lee una opción con su valor por defecto: dgm_opcion( 'titulo' ).
 */
function dgm_opcion( $clave ) {
	$defecto = dgm_opciones_por_defecto();
	return get_theme_mod( 'dgm_' . $clave, $defecto[ $clave ] ?? '' );
}

/**
 * Registro de los campos en el Personalizador.
 */
add_action( 'customize_register', function ( WP_Customize_Manager $wpc ) {
	$d = dgm_opciones_por_defecto();

	$wpc->add_panel( 'dgm_panel', array(
		'title'    => 'Digital G+',
		'priority' => 20,
	) );

	$secciones = array(
		'dgm_portada'    => 'Portada',
		'dgm_nosotros'   => 'Quiénes somos',
		'dgm_contacto'   => 'Contacto y WhatsApp',
		'dgm_formulario' => 'Formulario y Google Tag Manager',
	);
	foreach ( $secciones as $id => $titulo ) {
		$wpc->add_section( $id, array( 'title' => $titulo, 'panel' => 'dgm_panel' ) );
	}

	$campos = array(
		// clave => [sección, etiqueta, tipo, descripción]
		'descripcion'       => array( 'dgm_portada', 'Descripción para buscadores', 'textarea', 'Texto que muestran Google y las redes al compartir la portada (máx. ~160 caracteres).' ),
		'antetitulo'        => array( 'dgm_portada', 'Antetítulo', 'text', '' ),
		'titulo'            => array( 'dgm_portada', 'Título principal (h1)', 'textarea', '' ),
		'bajada'            => array( 'dgm_portada', 'Bajada del título', 'textarea', '' ),
		'hero_imagen'       => array( 'dgm_portada', 'Imagen principal', 'imagen', 'Se muestra a la derecha del título.' ),
		'partner_titulo'    => array( 'dgm_portada', 'Frase de Bibliotheca', 'text', 'Banda oscura de la portada, pie y Quiénes somos.' ),
		'partner_foto_1'    => array( 'dgm_portada', 'Foto 1 de la banda Bibliotheca', 'imagen', '' ),
		'partner_foto_2'    => array( 'dgm_portada', 'Foto 2 de la banda Bibliotheca', 'imagen', '' ),
		'nosotros_titulo'   => array( 'dgm_portada', 'Título del bloque Quiénes somos', 'text', '' ),
		'nosotros_bajada'   => array( 'dgm_portada', 'Texto del bloque Quiénes somos', 'textarea', '' ),
		'nosotros_imagen'   => array( 'dgm_portada', 'Imagen de Quiénes somos', 'imagen', 'Se usa en la portada y en la página Quiénes somos.' ),
		'clientes_titulo'   => array( 'dgm_portada', 'Título del muro de clientes', 'text', '' ),
		'mision'            => array( 'dgm_nosotros', 'Misión', 'textarea', 'Si se deja vacío no se muestra.' ),
		'vision'            => array( 'dgm_nosotros', 'Visión', 'textarea', 'Si se deja vacío no se muestra.' ),
		'equipo'            => array( 'dgm_nosotros', 'Equipo', 'textarea', 'Si se deja vacío no se muestra.' ),
		'mostrar_pendiente' => array( 'dgm_nosotros', 'Mostrar recuadros [PENDIENTE]', 'checkbox', 'Marca dónde falta texto (misión, visión, equipo, dirección, horario). Desmárcalo antes de lanzar el sitio.' ),
		'correo'            => array( 'dgm_contacto', 'Correo', 'email', '' ),
		'telefono'          => array( 'dgm_contacto', 'Teléfono (como se muestra)', 'text', 'Ejemplo: +56 9 7389 1319' ),
		'whatsapp'          => array( 'dgm_contacto', 'Número de WhatsApp', 'text', 'Solo números, con código de país. Ejemplo: 56973891319' ),
		'whatsapp_mensaje'  => array( 'dgm_contacto', 'Mensaje inicial de WhatsApp', 'textarea', '' ),
		'direccion'         => array( 'dgm_contacto', 'Dirección', 'textarea', 'Si se deja vacío no se muestra.' ),
		'horario'           => array( 'dgm_contacto', 'Horario de atención', 'textarea', 'Si se deja vacío no se muestra.' ),
		'form_accion'       => array( 'dgm_formulario', 'Dirección de envío del formulario', 'url', 'FormSubmit: https://formsubmit.co/ seguido del correo o de la cadena aleatoria que entrega FormSubmit al activarlo.' ),
		'form_asunto'       => array( 'dgm_formulario', 'Asunto del correo', 'text', '' ),
		'gtm'               => array( 'dgm_formulario', 'ID de Google Tag Manager', 'text', 'Ejemplo: GTM-PCLFRV6. Vacío desactiva GTM.' ),
	);

	foreach ( $campos as $clave => $c ) {
		list( $seccion, $etiqueta, $tipo, $ayuda ) = $c;
		$saneado = 'sanitize_text_field';
		if ( 'textarea' === $tipo ) {
			$saneado = 'sanitize_textarea_field';
		} elseif ( 'email' === $tipo ) {
			$saneado = 'sanitize_email';
		} elseif ( 'url' === $tipo ) {
			$saneado = 'esc_url_raw';
		} elseif ( 'checkbox' === $tipo ) {
			$saneado = 'rest_sanitize_boolean';
		} elseif ( 'imagen' === $tipo ) {
			$saneado = 'absint';
		}
		$wpc->add_setting( 'dgm_' . $clave, array(
			'default'           => $d[ $clave ],
			'sanitize_callback' => $saneado,
		) );
		if ( 'imagen' === $tipo ) {
			$wpc->add_control( new WP_Customize_Media_Control( $wpc, 'dgm_' . $clave, array(
				'label'       => $etiqueta,
				'description' => $ayuda,
				'section'     => $seccion,
				'mime_type'   => 'image',
			) ) );
		} else {
			$wpc->add_control( 'dgm_' . $clave, array(
				'label'       => $etiqueta,
				'description' => $ayuda,
				'section'     => $seccion,
				'type'        => $tipo,
			) );
		}
	}
} );
