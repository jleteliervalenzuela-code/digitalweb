<?php
/**
 * NUESTROS CLIENTES: muro de logos (menú «Clientes»).
 *
 * @package digitalgmas
 */

defined( 'ABSPATH' ) || exit;
get_header();
echo dgm_migas( array( array( 'Clientes' ) ) ); // phpcs:ignore
?>

<section class="cabeza-pagina">
	<div class="contenedor">
		<p class="antetitulo">Clientes</p>
		<h1><?php echo esc_html( dgm_opcion( 'clientes_titulo' ) ); ?></h1>
	</div>
</section>

<section class="seccion seccion--sin-arriba" aria-label="Instituciones clientes">
	<div class="contenedor">
		<?php echo dgm_logos(); // phpcs:ignore ?>
	</div>
</section>

<?php
echo dgm_cierre(); // phpcs:ignore
get_footer();
