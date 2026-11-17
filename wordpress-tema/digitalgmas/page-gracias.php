<?php
/**
 * Página a la que vuelve FormSubmit cuando el formulario se envía sin JavaScript
 * (Páginas → Contacto → Gracias, dirección /contacto/gracias/).
 *
 * @package digitalgmas
 */

defined( 'ABSPATH' ) || exit;
add_filter( 'wp_robots', 'wp_robots_no_robots' );
get_header();
?>
<section class="seccion pagina-404">
	<div class="contenedor encabezado encabezado--centro encabezado--solo">
		<p class="antetitulo">Contacto</p>
		<h1>Gracias, recibimos tu solicitud</h1>
		<p class="bajada">Te responderemos a la brevedad en el correo que nos indicaste.</p>
		<div class="acciones">
			<a class="boton boton--principal" href="<?php echo esc_url( home_url( '/' ) ); ?>">Volver al inicio</a>
			<a class="boton boton--secundario" href="<?php echo esc_url( home_url( '/nuestros-servicios/' ) ); ?>">Ver servicios</a>
		</div>
	</div>
</section>
<?php
get_footer();
