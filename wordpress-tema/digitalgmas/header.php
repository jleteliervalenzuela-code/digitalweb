<?php
/**
 * Cabecera del sitio (una sola vez para todas las páginas).
 * El menú de servicios se arma solo con los Servicios y Líneas del panel.
 *
 * @package digitalgmas
 */

defined( 'ABSPATH' ) || exit;

$dgm_actual = '';
if ( is_front_page() ) {
	$dgm_actual = 'inicio';
} elseif ( is_page( 'quienes-somos' ) ) {
	$dgm_actual = 'quienes-somos';
} elseif ( is_singular( 'servicio' ) || is_page( 'nuestros-servicios' ) ) {
	$dgm_actual = 'servicios';
} elseif ( is_page( 'nuestros-clientes' ) ) {
	$dgm_actual = 'clientes';
} elseif ( is_page( 'contacto' ) ) {
	$dgm_actual = 'contacto';
}
$dgm_actual_attr = function ( $clave ) use ( $dgm_actual ) {
	return $clave === $dgm_actual ? ' aria-current="page"' : '';
};
$dgm_lineas = dgm_lineas();
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="saltar" href="#contenido">Saltar al contenido</a>

<header class="cabecera">
	<div class="contenedor cabecera__fila">
		<a class="cabecera__logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="Digital G+, ir al inicio">
			<img src="<?php echo esc_url( DGM_URI . '/assets/img/marca/logo.png' ); ?>" alt="Digital G+" width="292" height="124">
		</a>

		<nav class="nav" aria-label="Principal">
			<ul class="nav__lista">
				<li><a class="nav__enlace" href="<?php echo esc_url( home_url( '/' ) ); ?>"<?php echo $dgm_actual_attr( 'inicio' ); // phpcs:ignore ?>>Inicio</a></li>
				<li><a class="nav__enlace" href="<?php echo esc_url( home_url( '/quienes-somos/' ) ); ?>"<?php echo $dgm_actual_attr( 'quienes-somos' ); // phpcs:ignore ?>>Quiénes somos</a></li>
				<li>
					<button class="nav__enlace" type="button" aria-expanded="false" aria-controls="panel-servicios" data-panel<?php echo 'servicios' === $dgm_actual ? ' aria-current="true"' : ''; ?>>
						Servicios <?php echo dgm_icono( 'chevron-down' ); // phpcs:ignore ?>
					</button>
					<div class="panel" id="panel-servicios" hidden>
						<div class="contenedor panel__rejilla">
							<?php foreach ( $dgm_lineas as $dgm_linea ) : ?>
							<div>
								<a class="panel__titulo" href="<?php echo esc_url( home_url( '/nuestros-servicios/#' . $dgm_linea->slug ) ); ?>"><?php echo esc_html( $dgm_linea->name ); ?></a>
								<ul>
									<?php foreach ( dgm_servicios( $dgm_linea ) as $dgm_s ) : ?>
									<li><a href="<?php echo esc_url( get_permalink( $dgm_s ) ); ?>"><?php echo esc_html( dgm_nombre_menu( $dgm_s ) ); ?></a></li>
									<?php endforeach; ?>
								</ul>
							</div>
							<?php endforeach; ?>
							<div class="panel__destacado">
								<p><?php echo esc_html( dgm_opcion( 'partner_titulo' ) ); ?>.</p>
								<a class="enlace-flecha" href="<?php echo esc_url( home_url( '/nuestros-servicios/' ) ); ?>">Ver todos los servicios <?php echo dgm_icono( 'arrow-right' ); // phpcs:ignore ?></a>
							</div>
						</div>
					</div>
				</li>
				<li><a class="nav__enlace" href="<?php echo esc_url( home_url( '/nuestros-clientes/' ) ); ?>"<?php echo $dgm_actual_attr( 'clientes' ); // phpcs:ignore ?>>Clientes</a></li>
				<li><a class="nav__enlace" href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>"<?php echo $dgm_actual_attr( 'contacto' ); // phpcs:ignore ?>>Contacto</a></li>
			</ul>
		</nav>

		<a class="boton boton--principal boton--chico cabecera__cta" href="<?php echo esc_url( dgm_url_contacto() ); ?>">Solicitar cotización</a>

		<button class="menu-boton" type="button" aria-expanded="false" aria-controls="menu-movil" aria-label="Abrir menú" data-menu>
			<?php echo dgm_icono( 'menu', 'icono icono-abrir' ) . dgm_icono( 'x', 'icono icono-cerrar' ); // phpcs:ignore ?>
		</button>
	</div>

	<nav class="menu-movil" id="menu-movil" aria-label="Principal (móvil)" hidden>
		<ul>
			<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"<?php echo $dgm_actual_attr( 'inicio' ); // phpcs:ignore ?>>Inicio</a></li>
			<li><a href="<?php echo esc_url( home_url( '/quienes-somos/' ) ); ?>"<?php echo $dgm_actual_attr( 'quienes-somos' ); // phpcs:ignore ?>>Quiénes somos</a></li>
			<li>
				<details>
					<summary>Servicios <?php echo dgm_icono( 'chevron-down' ); // phpcs:ignore ?></summary>
					<div class="grupo">
						<?php foreach ( $dgm_lineas as $dgm_linea ) : ?>
						<p class="grupo__titulo"><?php echo esc_html( $dgm_linea->name ); ?></p>
						<ul>
							<?php foreach ( dgm_servicios( $dgm_linea ) as $dgm_s ) : ?>
							<li><a href="<?php echo esc_url( get_permalink( $dgm_s ) ); ?>"><?php echo esc_html( dgm_nombre_menu( $dgm_s ) ); ?></a></li>
							<?php endforeach; ?>
						</ul>
						<?php endforeach; ?>
						<p class="grupo__titulo"><a href="<?php echo esc_url( home_url( '/nuestros-servicios/' ) ); ?>">Ver todos los servicios</a></p>
					</div>
				</details>
			</li>
			<li><a href="<?php echo esc_url( home_url( '/nuestros-clientes/' ) ); ?>"<?php echo $dgm_actual_attr( 'clientes' ); // phpcs:ignore ?>>Clientes</a></li>
			<li><a href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>"<?php echo $dgm_actual_attr( 'contacto' ); // phpcs:ignore ?>>Contacto</a></li>
		</ul>
		<div class="acciones">
			<a class="boton boton--principal" href="<?php echo esc_url( dgm_url_contacto() ); ?>">Solicitar cotización</a>
			<?php echo dgm_boton_whatsapp(); // phpcs:ignore ?>
		</div>
	</nav>
</header>

<main id="contenido" tabindex="-1">
