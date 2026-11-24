<?php
/**
 * Importador del contenido inicial: Digital G+ → Importar contenido.
 *
 * Crea las páginas, las líneas, los 15 servicios, los 19 clientes y sube
 * las imágenes a la biblioteca de medios, tomando todo de
 * importar/contenido.json e importar/img/. Trabaja paso a paso (una imagen
 * por solicitud) para no superar el tiempo máximo de PHP en hostings compartidos.
 *
 * Es seguro ejecutarlo más de una vez: no duplica ni sobrescribe lo que ya existe.
 *
 * @package digitalgmas
 */

defined( 'ABSPATH' ) || exit;

/** Contenido a importar. */
function dgm_import_datos() {
	static $datos = null;
	if ( null === $datos ) {
		$json  = file_get_contents( DGM_DIR . '/importar/contenido.json' ); // phpcs:ignore
		$datos = json_decode( $json, true );
	}
	return $datos;
}

/** Lista de pasos. */
function dgm_import_pasos() {
	$pasos = array( array( 'base' ) );
	foreach ( dgm_import_datos()['imagenes'] as $i => $img ) {
		$pasos[] = array( 'imagen', $i );
	}
	foreach ( array( 'lineas', 'servicios', 'clientes', 'paginas', 'final' ) as $p ) {
		$pasos[] = array( $p );
	}
	return $pasos;
}

/** ID del adjunto importado a partir del nombre de archivo. */
function dgm_import_id( $archivo ) {
	$mapa = get_option( 'dgm_import_mapa', array() );
	return $archivo && isset( $mapa[ $archivo ] ) ? (int) $mapa[ $archivo ] : 0;
}

/** Párrafos en formato del editor de bloques. */
function dgm_import_bloques( $parrafos ) {
	$html = '';
	foreach ( $parrafos as $p ) {
		$html .= "<!-- wp:paragraph -->\n<p>" . esc_html( $p ) . "</p>\n<!-- /wp:paragraph -->\n\n";
	}
	return trim( $html, " \n\r\t\v\0" );
}

/**
 * Ejecuta un paso. Devuelve un mensaje para el registro.
 */
function dgm_import_ejecutar( $paso ) {
	$d = dgm_import_datos();
	switch ( $paso[0] ) {

		case 'base':
			update_option( 'permalink_structure', '/%postname%/' );
			update_option( 'default_comment_status', 'closed' );
			update_option( 'default_ping_status', 'closed' );
			update_option( 'blogname', $d['sitio']['nombre'] );
			update_option( 'blogdescription', $d['sitio']['lema'] );
			// Contenido de ejemplo de una instalación nueva: a la papelera (recuperable)
			$quitados = 0;
			foreach ( array( 'hello-world', 'hola-mundo' ) as $slug ) {
				$p = get_page_by_path( $slug, OBJECT, 'post' );
				if ( $p ) {
					wp_trash_post( $p->ID );
					$quitados++;
				}
			}
			foreach ( array( 'sample-page', 'pagina-ejemplo', 'pagina-de-ejemplo' ) as $slug ) {
				$p = get_page_by_path( $slug, OBJECT, 'page' );
				if ( $p ) {
					wp_trash_post( $p->ID );
					$quitados++;
				}
			}
			return 'Ajustes básicos listos (enlaces permanentes, comentarios cerrados). Contenido de ejemplo enviado a la papelera: ' . $quitados . '.';

		case 'imagen':
			require_once ABSPATH . 'wp-admin/includes/image.php';
			$img  = $d['imagenes'][ $paso[1] ];
			$mapa = get_option( 'dgm_import_mapa', array() );
			if ( ! empty( $mapa[ $img['archivo'] ] ) && get_post( $mapa[ $img['archivo'] ] ) ) {
				return 'Imagen ya importada: ' . $img['archivo'];
			}
			$origen = DGM_DIR . '/importar/img/' . $img['archivo'];
			if ( ! file_exists( $origen ) ) {
				return 'No se encontró la imagen ' . $img['archivo'];
			}
			$subida = wp_upload_bits( basename( $origen ), null, file_get_contents( $origen ) ); // phpcs:ignore
			if ( ! empty( $subida['error'] ) ) {
				return 'Error al subir ' . $img['archivo'] . ': ' . $subida['error'];
			}
			$tipo = wp_check_filetype( $subida['file'] );
			$id   = wp_insert_attachment( array(
				'post_mime_type' => $tipo['type'],
				'post_title'     => $img['titulo'],
				'post_status'    => 'inherit',
			), $subida['file'] );
			wp_update_attachment_metadata( $id, wp_generate_attachment_metadata( $id, $subida['file'] ) );
			update_post_meta( $id, '_wp_attachment_image_alt', $img['alt'] );
			$mapa[ $img['archivo'] ] = $id;
			update_option( 'dgm_import_mapa', $mapa, false );
			return 'Imagen importada: ' . $img['archivo'];

		case 'lineas':
			foreach ( $d['lineas'] as $l ) {
				$t = get_term_by( 'slug', $l['slug'], 'linea' );
				if ( ! $t ) {
					$r = wp_insert_term( $l['nombre'], 'linea', array( 'slug' => $l['slug'], 'description' => $l['descripcion'] ) );
					if ( is_wp_error( $r ) ) {
						return 'Error al crear la línea ' . $l['nombre'] . ': ' . $r->get_error_message();
					}
					$t_id = $r['term_id'];
					update_term_meta( $t_id, 'dgm_imagen', dgm_import_id( $l['imagen'] ) );
					update_term_meta( $t_id, 'dgm_orden', (int) $l['orden'] );
				}
			}
			return 'Líneas de servicio creadas: ' . count( $d['lineas'] ) . '.';

		case 'servicios':
			$creados = 0;
			foreach ( $d['servicios'] as $s ) {
				if ( get_page_by_path( $s['slug'], OBJECT, 'servicio' ) ) {
					continue;
				}
				$id = wp_insert_post( array(
					'post_type'    => 'servicio',
					'post_status'  => 'publish',
					'post_title'   => $s['nombre'],
					'post_name'    => $s['slug'],
					'post_content' => dgm_import_bloques( $s['parrafos'] ),
					'menu_order'   => (int) $s['orden'],
				), true );
				if ( is_wp_error( $id ) ) {
					return 'Error al crear ' . $s['nombre'] . ': ' . $id->get_error_message();
				}
				$t = get_term_by( 'slug', $s['linea'], 'linea' );
				if ( $t ) {
					wp_set_object_terms( $id, array( (int) $t->term_id ), 'linea' );
				}
				if ( $s['foto'] ) {
					set_post_thumbnail( $id, dgm_import_id( $s['foto'] ) );
				}
				$meta = array(
					'dgm_nombre_corto' => $s['nombre_corto'],
					'dgm_bajada'       => $s['bajada'],
					'dgm_lista_titulo' => $s['lista_titulo'],
					'dgm_lista'        => implode( "\n", $s['lista'] ),
					'dgm_enlace_texto' => $s['enlace_texto'],
					'dgm_enlace_url'   => $s['enlace_url'],
					'dgm_galeria'      => implode( ',', array_filter( array_map( 'dgm_import_id', $s['galeria'] ) ) ),
					'dgm_franja'       => (string) dgm_import_id( $s['franja'] ),
				);
				foreach ( $meta as $k => $v ) {
					update_post_meta( $id, $k, $v );
				}
				$creados++;
			}
			return 'Servicios creados: ' . $creados . '.';

		case 'clientes':
			$creados = 0;
			foreach ( $d['clientes'] as $c ) {
				$existe = get_posts( array( 'post_type' => 'cliente', 'title' => $c['nombre'], 'post_status' => 'any', 'numberposts' => 1 ) );
				if ( $existe ) {
					continue;
				}
				$id = wp_insert_post( array(
					'post_type'   => 'cliente',
					'post_status' => 'publish',
					'post_title'  => $c['nombre'],
					'menu_order'  => (int) $c['orden'],
				) );
				set_post_thumbnail( $id, dgm_import_id( $c['logo'] ) );
				$creados++;
			}
			return 'Clientes creados: ' . $creados . '.';

		case 'paginas':
			$ids = array();
			foreach ( $d['paginas'] as $p ) {
				$ruta = $p['padre'] ? $p['padre'] . '/' . $p['slug'] : $p['slug'];
				$ya   = get_page_by_path( $ruta, OBJECT, 'page' );
				if ( $ya ) {
					$ids[ $p['slug'] ] = $ya->ID;
					continue;
				}
				$ids[ $p['slug'] ] = wp_insert_post( array(
					'post_type'    => 'page',
					'post_status'  => 'publish',
					'post_title'   => $p['titulo'],
					'post_name'    => $p['slug'],
					'post_content' => dgm_import_bloques( $p['parrafos'] ),
					'post_excerpt' => $p['extracto'],
					'post_parent'  => $p['padre'] ? ( $ids[ $p['padre'] ] ?? 0 ) : 0,
				) );
			}
			if ( ! empty( $ids['inicio'] ) ) {
				update_option( 'show_on_front', 'page' );
				update_option( 'page_on_front', $ids['inicio'] );
			}
			return 'Páginas creadas y portada asignada.';

		case 'final':
			foreach ( $d['opciones_imagen'] as $clave => $archivo ) {
				if ( ! get_theme_mod( 'dgm_' . $clave ) ) {
					set_theme_mod( 'dgm_' . $clave, dgm_import_id( $archivo ) );
				}
			}
			flush_rewrite_rules();
			update_option( 'dgm_importado', DGM_VERSION );
			return 'Importación terminada.';
	}
	return 'Paso desconocido.';
}

/* ------------------------------------------------------------------
 * Pantalla del panel y llamadas AJAX
 * ------------------------------------------------------------------ */
add_action( 'admin_menu', function () {
	add_menu_page( 'Digital G+', 'Digital G+', 'manage_options', 'dgm-importar', 'dgm_pantalla_importar', 'dashicons-admin-site-alt3', 3 );
	add_submenu_page( 'dgm-importar', 'Importar contenido', 'Importar contenido', 'manage_options', 'dgm-importar', 'dgm_pantalla_importar' );
} );

/* Aviso mientras falte importar */
add_action( 'admin_notices', function () {
	if ( get_option( 'dgm_importado' ) || ! current_user_can( 'manage_options' ) ) {
		return;
	}
	$pantalla = get_current_screen();
	if ( $pantalla && 'toplevel_page_dgm-importar' === $pantalla->id ) {
		return;
	}
	echo '<div class="notice notice-warning"><p><strong>Tema Digital G+:</strong> falta cargar el contenido del sitio. <a class="button button-primary" href="' . esc_url( admin_url( 'admin.php?page=dgm-importar' ) ) . '">Importar contenido</a></p></div>';
} );

/* Al activar el tema, ir directo a la pantalla de importación */
add_action( 'after_switch_theme', function () {
	if ( ! get_option( 'dgm_importado' ) ) {
		set_transient( 'dgm_ir_a_importar', 1, 60 );
	}
} );
add_action( 'admin_init', function () {
	if ( get_transient( 'dgm_ir_a_importar' ) && current_user_can( 'manage_options' ) && ! wp_doing_ajax() ) {
		delete_transient( 'dgm_ir_a_importar' );
		wp_safe_redirect( admin_url( 'admin.php?page=dgm-importar' ) );
		exit;
	}
} );

function dgm_pantalla_importar() {
	$total    = count( dgm_import_pasos() );
	$hecho    = get_option( 'dgm_importado' );
	$nonce    = wp_create_nonce( 'dgm_importar' );
	$d        = dgm_import_datos();
	?>
	<div class="wrap">
		<h1>Digital G+ · Importar contenido</h1>
		<?php if ( $hecho ) : ?>
			<div class="notice notice-success inline"><p>El contenido ya fue importado. <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Ver el sitio</a>.</p></div>
			<p>Puedes volver a ejecutar la importación: solo crea lo que falte (por ejemplo, un servicio que borraste por error). No modifica lo que ya editaste.</p>
		<?php else : ?>
			<p>Esto cargará en tu WordPress el contenido del sitio de Digital G+:</p>
			<ul style="list-style:disc;padding-left:2em">
				<li><?php echo count( $d['paginas'] ); ?> páginas (Inicio, Quiénes somos, Servicios, Clientes, Contacto y Gracias)</li>
				<li><?php echo count( $d['lineas'] ); ?> líneas y <?php echo count( $d['servicios'] ); ?> servicios con sus textos y fotos</li>
				<li><?php echo count( $d['clientes'] ); ?> clientes con su logo</li>
				<li><?php echo count( $d['imagenes'] ); ?> imágenes en la biblioteca de medios</li>
			</ul>
			<p>Además ajusta los enlaces permanentes a «Nombre de la entrada», asigna la portada, cierra los comentarios y envía a la papelera la entrada y la página de ejemplo de WordPress. Tarda uno o dos minutos; no cierres esta pestaña.</p>
		<?php endif; ?>
		<p><button type="button" class="button button-primary button-hero" id="dgm-iniciar"><?php echo $hecho ? 'Volver a ejecutar' : 'Importar contenido'; ?></button></p>
		<progress id="dgm-barra" max="<?php echo (int) $total; ?>" value="0" style="width:100%;max-width:640px;height:22px;display:none"></progress>
		<p id="dgm-estado" aria-live="polite"></p>
		<details><summary>Registro</summary><ol id="dgm-registro" style="max-height:300px;overflow:auto;font-family:monospace;font-size:12px"></ol></details>
	</div>
	<script>
	(function () {
		var boton = document.getElementById('dgm-iniciar'), barra = document.getElementById('dgm-barra'),
			estado = document.getElementById('dgm-estado'), registro = document.getElementById('dgm-registro'),
			total = <?php echo (int) $total; ?>;
		function paso(n) {
			var datos = new FormData();
			datos.append('action', 'dgm_importar');
			datos.append('paso', n);
			datos.append('_ajax_nonce', '<?php echo esc_js( $nonce ); ?>');
			fetch(ajaxurl, { method: 'POST', body: datos, credentials: 'same-origin' })
				.then(function (r) { return r.json(); })
				.then(function (r) {
					if (!r.success) { throw new Error(r.data || 'Error'); }
					var li = document.createElement('li'); li.textContent = r.data.mensaje; registro.appendChild(li);
					barra.value = n + 1;
					estado.textContent = 'Paso ' + (n + 1) + ' de ' + total + ': ' + r.data.mensaje;
					if (n + 1 < total) { paso(n + 1); }
					else { estado.innerHTML = '<strong>¡Listo!</strong> El sitio está cargado. <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Ver el sitio</a>'; boton.disabled = false; }
				})
				.catch(function (e) {
					estado.textContent = 'Se detuvo en el paso ' + (n + 1) + ' (' + e.message + '). Pulsa el botón para continuar: no se duplica nada.';
					boton.disabled = false;
				});
		}
		boton.addEventListener('click', function () {
			boton.disabled = true; barra.style.display = 'block'; registro.innerHTML = '';
			paso(0);
		});
	})();
	</script>
	<?php
}

add_action( 'wp_ajax_dgm_importar', function () {
	check_ajax_referer( 'dgm_importar' );
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_send_json_error( 'Sin permisos.' );
	}
	$pasos = dgm_import_pasos();
	$n     = isset( $_POST['paso'] ) ? absint( $_POST['paso'] ) : 0;
	if ( ! isset( $pasos[ $n ] ) ) {
		wp_send_json_error( 'Paso inválido.' );
	}
	if ( function_exists( 'set_time_limit' ) ) {
		@set_time_limit( 120 ); // phpcs:ignore
	}
	wp_send_json_success( array( 'mensaje' => dgm_import_ejecutar( $pasos[ $n ] ) ) );
} );
