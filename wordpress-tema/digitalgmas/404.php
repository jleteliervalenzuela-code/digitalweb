<?php
/**
 * Página no encontrada.
 *
 * @package digitalgmas
 */

defined( 'ABSPATH' ) || exit;
get_header();
?>
<section class="seccion pagina-404">
	<div class="contenedor encabezado encabezado--centro encabezado--solo">
		<p class="antetitulo">Error 404</p>
		<h1>No encontramos esta página</h1>
		<p class="bajada">Puede que la dirección haya cambiado. Revisa nuestros servicios o escríbenos.</p>
		<div class="acciones">
			<a class="boton boton--principal" href="<?php echo esc_url( home_url( '/nuestros-servicios/' ) ); ?>">Ver servicios</a>
			<a class="boton boton--secundario" href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>">Ir a contacto</a>
		</div>
	</div>
</section>
<?php
get_footer();
