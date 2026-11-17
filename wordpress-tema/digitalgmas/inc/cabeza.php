<?php
/**
 * Todo lo que va en <head>: estilos, scripts, SEO, Open Graph,
 * datos estructurados y Google Tag Manager. También limpia lo que
 * WordPress agrega por defecto y este sitio no usa.
 *
 * @package digitalgmas
 */

defined( 'ABSPATH' ) || exit;

/* Estilos y scripts del sitio */
add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style( 'dgm-estilos', DGM_URI . '/assets/css/estilos.css', array(), DGM_VERSION );
	wp_enqueue_script( 'dgm-sitio', DGM_URI . '/assets/js/sitio.js', array(), DGM_VERSION, array( 'strategy' => 'defer', 'in_footer' => false ) );
	// Estilos de bloques que este tema no usa (el sitio tiene su propio diseño)
	foreach ( array( 'wp-block-library', 'wp-block-library-theme', 'global-styles', 'classic-theme-styles' ) as $h ) {
		wp_dequeue_style( $h );
	}
}, 20 );

/* Quitar emojis, oEmbed y enlaces que el sitio no necesita */
add_action( 'init', function () {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wp_shortlink_wp_head' );
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
	remove_action( 'wp_head', 'feed_links', 2 );
	remove_action( 'wp_head', 'feed_links_extra', 3 );
} );

/* Título: «Página | Digital G+» */
add_filter( 'document_title_separator', function () {
	return '|';
} );

/**
 * Descripción de la página actual (para buscadores y redes).
 */
function dgm_descripcion() {
	if ( is_front_page() ) {
		return dgm_opcion( 'descripcion' );
	}
	if ( is_singular( 'servicio' ) ) {
		$bajada = get_post_meta( get_the_ID(), 'dgm_bajada', true );
		$texto  = $bajada ? $bajada : wp_strip_all_tags( get_post_field( 'post_content', get_the_ID() ) );
		$texto  = trim( preg_replace( '/\s+/', ' ', $texto ) );
		$corte  = strpos( $texto, '. ' );
		$texto  = false !== $corte ? substr( $texto, 0, $corte + 1 ) : $texto;
		return mb_strlen( $texto ) > 160 ? rtrim( mb_substr( $texto, 0, 157 ) ) . '…' : $texto;
	}
	if ( is_singular() && has_excerpt() ) {
		return get_the_excerpt();
	}
	return '';
}

add_action( 'wp_head', function () {
	$descripcion = dgm_descripcion();
	if ( ! $descripcion ) {
		$descripcion = dgm_opcion( 'descripcion' );
	}
	$titulo = wp_get_document_title();
	$url    = is_singular() ? get_permalink() : home_url( add_query_arg( array() ) );
	$imagen = DGM_URI . '/assets/img/marca/og.jpg';
	if ( is_singular( 'servicio' ) ) {
		$id = get_post_thumbnail_id() ?: (int) get_post_meta( get_the_ID(), 'dgm_franja', true );
		if ( $id ) {
			$imagen = wp_get_attachment_image_url( $id, 'large' );
		}
	}
	$correo = dgm_opcion( 'correo' );
	?>
	<meta name="description" content="<?php echo esc_attr( $descripcion ); ?>">
	<meta property="og:type" content="website">
	<meta property="og:locale" content="es_CL">
	<meta property="og:site_name" content="Digital G+">
	<meta property="og:title" content="<?php echo esc_attr( $titulo ); ?>">
	<meta property="og:description" content="<?php echo esc_attr( $descripcion ); ?>">
	<meta property="og:url" content="<?php echo esc_url( $url ); ?>">
	<meta property="og:image" content="<?php echo esc_url( $imagen ); ?>">
	<meta name="twitter:card" content="summary_large_image">
	<meta name="theme-color" content="#fafbff">
	<link rel="icon" href="<?php echo esc_url( DGM_URI . '/assets/img/marca/favicon-48.png' ); ?>" type="image/png" sizes="48x48">
	<link rel="apple-touch-icon" href="<?php echo esc_url( DGM_URI . '/assets/img/marca/apple-touch-icon.png' ); ?>">
	<link rel="preload" href="<?php echo esc_url( DGM_URI . '/assets/fonts/manrope-latin-wght-normal.woff2' ); ?>" as="font" type="font/woff2" crossorigin>
	<script>document.documentElement.classList.add("js")</script>
	<script type="application/ld+json"><?php
	echo wp_json_encode( array(
		'@context'   => 'https://schema.org',
		'@type'      => 'Organization',
		'name'       => 'Digital G+',
		'url'        => home_url( '/' ),
		'logo'       => DGM_URI . '/assets/img/marca/logo.png',
		'email'      => $correo,
		'telephone'  => dgm_tel(),
		'areaServed' => 'CL',
	), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );
	?></script>
	<?php
	// Google Tag Manager (no se carga para usuarios con sesión iniciada, para no contar visitas internas)
	$gtm = preg_replace( '/[^A-Z0-9-]/', '', strtoupper( dgm_opcion( 'gtm' ) ) );
	if ( $gtm && ! is_user_logged_in() ) {
		?>
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','<?php echo esc_js( $gtm ); ?>');</script>
	<!-- Fin Google Tag Manager -->
		<?php
	}
}, 1 );

/* GTM sin JavaScript, al inicio de <body> */
add_action( 'wp_body_open', function () {
	$gtm = preg_replace( '/[^A-Z0-9-]/', '', strtoupper( dgm_opcion( 'gtm' ) ) );
	if ( $gtm && ! is_user_logged_in() ) {
		echo '<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=' . esc_attr( $gtm ) . '" height="0" width="0" style="display:none;visibility:hidden" title="Google Tag Manager"></iframe></noscript>';
	}
} );

/* Mapa del sitio de WordPress: sin usuarios ni etiquetas */
add_filter( 'wp_sitemaps_add_provider', function ( $proveedor, $nombre ) {
	return 'users' === $nombre ? false : $proveedor;
}, 10, 2 );
add_filter( 'wp_sitemaps_taxonomies', '__return_empty_array' );
add_filter( 'wp_sitemaps_post_types', function ( $tipos ) {
	unset( $tipos['post'] );
	return $tipos;
} );
