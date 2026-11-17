<?php
/**
 * Tipos de contenido del sitio:
 *   - Servicio (dirección /servicio/<nombre>/), agrupado por Línea
 *   - Cliente (logo del muro de clientes)
 *   - Línea de servicio (Digitalización, Productos Bibliotheca, Plataformas con IA)
 * y sus campos en el panel de WordPress.
 *
 * @package digitalgmas
 */

defined( 'ABSPATH' ) || exit;

add_action( 'init', function () {

	register_post_type( 'servicio', array(
		'labels'        => array(
			'name'               => 'Servicios',
			'singular_name'      => 'Servicio',
			'add_new'            => 'Añadir servicio',
			'add_new_item'       => 'Añadir servicio',
			'edit_item'          => 'Editar servicio',
			'new_item'           => 'Nuevo servicio',
			'view_item'          => 'Ver servicio',
			'search_items'       => 'Buscar servicios',
			'not_found'          => 'No hay servicios',
			'all_items'          => 'Todos los servicios',
			'featured_image'     => 'Foto principal',
			'set_featured_image' => 'Elegir foto principal',
		),
		'public'        => true,
		'has_archive'   => false,
		'menu_icon'     => 'dashicons-book-alt',
		'menu_position' => 5,
		'show_in_rest'  => true,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
		'rewrite'       => array( 'slug' => 'servicio', 'with_front' => false ),
		// Sin variable de consulta: así ?servicio=... queda libre para preseleccionar
		// el servicio en el formulario de Contacto.
		'query_var'     => false,
		'template'      => array( array( 'core/paragraph' ) ),
	) );

	register_post_type( 'cliente', array(
		'labels'             => array(
			'name'               => 'Clientes',
			'singular_name'      => 'Cliente',
			'add_new'            => 'Añadir cliente',
			'add_new_item'       => 'Añadir cliente',
			'edit_item'          => 'Editar cliente',
			'all_items'          => 'Todos los clientes',
			'featured_image'     => 'Logo',
			'set_featured_image' => 'Elegir logo',
			'remove_featured_image' => 'Quitar logo',
		),
		'public'             => false,
		'show_ui'            => true,
		'menu_icon'          => 'dashicons-building',
		'menu_position'      => 6,
		'supports'           => array( 'title', 'thumbnail', 'page-attributes' ),
	) );

	register_taxonomy( 'linea', 'servicio', array(
		'labels'            => array(
			'name'          => 'Líneas de servicio',
			'singular_name' => 'Línea',
			'edit_item'     => 'Editar línea',
			'add_new_item'  => 'Añadir línea',
			'menu_name'     => 'Líneas',
		),
		'public'            => false,
		'show_ui'           => true,
		'show_in_rest'      => true,
		'hierarchical'      => true,
		'show_admin_column' => true,
		'rewrite'           => false,
	) );

	// Campos guardados como metadatos (también disponibles para el editor de bloques)
	foreach ( dgm_campos_servicio() as $clave => $campo ) {
		register_post_meta( 'servicio', $clave, array(
			'type'          => 'string',
			'single'        => true,
			'show_in_rest'  => true,
			'auth_callback' => function () {
				return current_user_can( 'edit_posts' );
			},
		) );
	}
} );

/**
 * Campos extra de cada servicio.
 */
function dgm_campos_servicio() {
	return array(
		'dgm_nombre_corto' => array( 'Nombre corto (menú)', 'text', 'Opcional. Se usa en el menú y el pie si el nombre es largo.' ),
		'dgm_bajada'       => array( 'Bajada', 'textarea', 'Opcional. Frase breve bajo el título.' ),
		'dgm_lista_titulo' => array( 'Título de la lista', 'text', 'Ejemplo: Entre las acciones que contempla el servicio' ),
		'dgm_lista'        => array( 'Ítems de la lista', 'textarea', 'Un ítem por línea.' ),
		'dgm_enlace_texto' => array( 'Texto del enlace externo', 'text', 'Ejemplo: Más información en Bibliotheca' ),
		'dgm_enlace_url'   => array( 'Dirección del enlace externo', 'url', '' ),
		'dgm_galeria'      => array( 'Galería', 'galeria', 'Fotos adicionales bajo el texto.' ),
		'dgm_franja'       => array( 'Franja (banner)', 'imagen', 'Imagen ancha que se muestra si el servicio no tiene foto principal.' ),
	);
}

/**
 * Los servicios se editan con el editor clásico: el texto arriba y todos
 * sus campos a la vista debajo (en el editor de bloques quedan plegados al pie).
 */
add_filter( 'use_block_editor_for_post_type', function ( $usar, $tipo ) {
	return 'servicio' === $tipo ? false : $usar;
}, 10, 2 );

/* ------------------------------------------------------------------
 * Caja de campos en la edición de cada servicio
 * ------------------------------------------------------------------ */
add_action( 'add_meta_boxes_servicio', function () {
	add_meta_box( 'dgm_servicio', 'Datos del servicio', 'dgm_caja_servicio', 'servicio', 'normal', 'high' );
} );

function dgm_caja_servicio( $post ) {
	wp_nonce_field( 'dgm_guardar_servicio', 'dgm_nonce' );
	echo '<div class="dgm-campos">';
	foreach ( dgm_campos_servicio() as $clave => $c ) {
		list( $etiqueta, $tipo, $ayuda ) = $c;
		$valor = get_post_meta( $post->ID, $clave, true );
		echo '<p><label for="' . esc_attr( $clave ) . '"><strong>' . esc_html( $etiqueta ) . '</strong></label><br>';
		if ( 'textarea' === $tipo ) {
			echo '<textarea class="widefat" rows="' . ( 'dgm_lista' === $clave ? 6 : 2 ) . '" id="' . esc_attr( $clave ) . '" name="' . esc_attr( $clave ) . '">' . esc_textarea( $valor ) . '</textarea>';
		} elseif ( 'galeria' === $tipo || 'imagen' === $tipo ) {
			dgm_campo_imagenes( $clave, $valor, 'galeria' === $tipo );
		} else {
			echo '<input class="widefat" type="' . ( 'url' === $tipo ? 'url' : 'text' ) . '" id="' . esc_attr( $clave ) . '" name="' . esc_attr( $clave ) . '" value="' . esc_attr( $valor ) . '">';
		}
		if ( $ayuda ) {
			echo '<br><span class="description">' . esc_html( $ayuda ) . '</span>';
		}
		echo '</p>';
	}
	echo '<p class="description">La línea de servicio se elige en el panel lateral («Líneas de servicio»). El orden en el sitio se define en «Atributos → Orden».</p>';
	echo '</div>';
}

/**
 * Campo de una o varias imágenes con el selector de medios de WordPress.
 */
function dgm_campo_imagenes( $nombre, $valor, $multiple ) {
	$ids = array_filter( array_map( 'absint', explode( ',', (string) $valor ) ) );
	echo '<span class="dgm-imagenes" data-multiple="' . ( $multiple ? '1' : '0' ) . '">';
	echo '<input type="hidden" name="' . esc_attr( $nombre ) . '" id="' . esc_attr( $nombre ) . '" value="' . esc_attr( implode( ',', $ids ) ) . '">';
	echo '<span class="dgm-miniaturas" style="display:flex;gap:6px;flex-wrap:wrap;margin:6px 0">';
	foreach ( $ids as $id ) {
		echo wp_get_attachment_image( $id, 'thumbnail', false, array( 'style' => 'width:72px;height:72px;object-fit:cover;border-radius:4px' ) );
	}
	echo '</span>';
	echo '<button type="button" class="button dgm-elegir">' . ( $multiple ? 'Elegir fotos' : 'Elegir imagen' ) . '</button> ';
	echo '<button type="button" class="button-link dgm-quitar">Quitar</button>';
	echo '</span>';
}

add_action( 'save_post_servicio', function ( $post_id ) {
	if ( ! isset( $_POST['dgm_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['dgm_nonce'] ), 'dgm_guardar_servicio' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	foreach ( dgm_campos_servicio() as $clave => $c ) {
		if ( ! isset( $_POST[ $clave ] ) ) {
			continue;
		}
		$bruto = wp_unslash( $_POST[ $clave ] );
		switch ( $c[1] ) {
			case 'textarea':
				$limpio = sanitize_textarea_field( $bruto );
				break;
			case 'url':
				$limpio = esc_url_raw( $bruto );
				break;
			case 'galeria':
			case 'imagen':
				$limpio = implode( ',', array_filter( array_map( 'absint', explode( ',', $bruto ) ) ) );
				break;
			default:
				$limpio = sanitize_text_field( $bruto );
		}
		update_post_meta( $post_id, $clave, $limpio );
	}
} );

/* ------------------------------------------------------------------
 * Campos de cada Línea: imagen y orden
 * ------------------------------------------------------------------ */
function dgm_campos_linea_html( $term = null ) {
	$imagen = $term ? get_term_meta( $term->term_id, 'dgm_imagen', true ) : '';
	$orden  = $term ? get_term_meta( $term->term_id, 'dgm_orden', true ) : '';
	$abre   = $term ? '<tr class="form-field"><th scope="row">' : '<div class="form-field">';
	$medio  = $term ? '</th><td>' : '';
	$cierra = $term ? '</td></tr>' : '</div>';
	echo $abre . '<label>Imagen de la línea</label>' . $medio; // phpcs:ignore
	dgm_campo_imagenes( 'dgm_imagen', $imagen, false );
	echo '<p class="description">Se muestra en las pestañas de la portada.</p>' . $cierra; // phpcs:ignore
	echo $abre . '<label for="dgm_orden">Orden</label>' . $medio; // phpcs:ignore
	echo '<input type="number" id="dgm_orden" name="dgm_orden" value="' . esc_attr( $orden ) . '" style="width:6em"><p class="description">1, 2, 3… Define el orden en el menú y la portada. La «Descripción» de la línea es la frase bajo su título.</p>' . $cierra; // phpcs:ignore
	wp_nonce_field( 'dgm_guardar_linea', 'dgm_nonce_linea' );
}
add_action( 'linea_add_form_fields', function () {
	dgm_campos_linea_html();
} );
add_action( 'linea_edit_form_fields', function ( $term ) {
	dgm_campos_linea_html( $term );
} );
$dgm_guardar_linea = function ( $term_id ) {
	if ( ! isset( $_POST['dgm_nonce_linea'] ) || ! wp_verify_nonce( sanitize_key( $_POST['dgm_nonce_linea'] ), 'dgm_guardar_linea' ) ) {
		return;
	}
	if ( isset( $_POST['dgm_imagen'] ) ) {
		update_term_meta( $term_id, 'dgm_imagen', absint( $_POST['dgm_imagen'] ) );
	}
	if ( isset( $_POST['dgm_orden'] ) ) {
		update_term_meta( $term_id, 'dgm_orden', absint( $_POST['dgm_orden'] ) );
	}
};
add_action( 'created_linea', $dgm_guardar_linea );
add_action( 'edited_linea', $dgm_guardar_linea );

/* Selector de medios en el panel */
add_action( 'admin_enqueue_scripts', function ( $hook ) {
	$pantalla = get_current_screen();
	if ( $pantalla && ( 'servicio' === $pantalla->post_type || 'linea' === $pantalla->taxonomy ) ) {
		wp_enqueue_media();
		wp_enqueue_script( 'dgm-admin', DGM_URI . '/assets/js/admin.js', array( 'jquery' ), DGM_VERSION, true );
	}
} );

/* ------------------------------------------------------------------
 * Consultas de apoyo para las plantillas
 * ------------------------------------------------------------------ */

/**
 * Líneas de servicio en orden.
 *
 * @return WP_Term[]
 */
function dgm_lineas() {
	$terminos = get_terms( array( 'taxonomy' => 'linea', 'hide_empty' => false ) );
	if ( is_wp_error( $terminos ) ) {
		return array();
	}
	usort( $terminos, function ( $a, $b ) {
		return (int) get_term_meta( $a->term_id, 'dgm_orden', true ) <=> (int) get_term_meta( $b->term_id, 'dgm_orden', true );
	} );
	return $terminos;
}

/**
 * Servicios de una línea (o todos), en el orden definido en «Atributos → Orden».
 *
 * @return WP_Post[]
 */
function dgm_servicios( $linea = null, $excluir = 0 ) {
	$args = array(
		'post_type'      => 'servicio',
		'posts_per_page' => -1,
		'orderby'        => array( 'menu_order' => 'ASC', 'title' => 'ASC' ),
		'post__not_in'   => $excluir ? array( $excluir ) : array(),
		'no_found_rows'  => true,
	);
	if ( $linea ) {
		$args['tax_query'] = array( array( 'taxonomy' => 'linea', 'field' => 'term_id', 'terms' => $linea->term_id ) ); // phpcs:ignore
	}
	return get_posts( $args );
}

/**
 * Clientes en orden.
 *
 * @return WP_Post[]
 */
function dgm_clientes() {
	return get_posts( array(
		'post_type'      => 'cliente',
		'posts_per_page' => -1,
		'orderby'        => array( 'menu_order' => 'ASC', 'title' => 'ASC' ),
		'no_found_rows'  => true,
	) );
}

/** Línea a la que pertenece un servicio. */
function dgm_linea_de( $post ) {
	$t = get_the_terms( $post, 'linea' );
	return ( $t && ! is_wp_error( $t ) ) ? $t[0] : null;
}

/** Nombre para el menú (nombre corto si existe). */
function dgm_nombre_menu( $post ) {
	$corto = get_post_meta( $post->ID, 'dgm_nombre_corto', true );
	return $corto ? $corto : get_the_title( $post );
}

/** Columna «Orden» en la lista de servicios y clientes. */
foreach ( array( 'servicio', 'cliente' ) as $dgm_tipo ) {
	add_filter( "manage_{$dgm_tipo}_posts_columns", function ( $c ) {
		$c['dgm_orden'] = 'Orden';
		return $c;
	} );
	add_action( "manage_{$dgm_tipo}_posts_custom_column", function ( $col, $id ) {
		if ( 'dgm_orden' === $col ) {
			echo (int) get_post_field( 'menu_order', $id );
		}
	}, 10, 2 );
}
add_action( 'pre_get_posts', function ( $q ) {
	if ( is_admin() && $q->is_main_query() && in_array( $q->get( 'post_type' ), array( 'servicio', 'cliente' ), true ) && ! $q->get( 'orderby' ) ) {
		$q->set( 'orderby', 'menu_order' );
		$q->set( 'order', 'ASC' );
	}
} );
