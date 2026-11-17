<?php
/**
 * NUESTROS SERVICIOS: los servicios agrupados por línea.
 * Se arma solo con el menú «Servicios» y «Líneas».
 *
 * @package digitalgmas
 */

defined( 'ABSPATH' ) || exit;
get_header();
$dgm_lineas = dgm_lineas();
echo dgm_migas( array( array( 'Servicios' ) ) ); // phpcs:ignore
?>

<section class="cabeza-pagina">
	<div class="contenedor">
		<p class="antetitulo">Qué hacemos</p>
		<h1><?php the_title(); ?></h1>
		<div class="acciones">
			<?php foreach ( $dgm_lineas as $dgm_linea ) : ?>
			<a class="boton boton--secundario boton--chico" href="#<?php echo esc_attr( $dgm_linea->slug ); ?>"><?php echo esc_html( $dgm_linea->name ); ?></a>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<?php foreach ( $dgm_lineas as $i => $dgm_linea ) : ?>
<section class="seccion<?php echo 0 === $i % 2 ? ' seccion--blanca' : ''; ?>" id="<?php echo esc_attr( $dgm_linea->slug ); ?>" aria-labelledby="titulo-<?php echo esc_attr( $dgm_linea->slug ); ?>">
	<div class="contenedor">
		<div class="encabezado revelar">
			<h2 id="titulo-<?php echo esc_attr( $dgm_linea->slug ); ?>"><?php echo esc_html( $dgm_linea->name ); ?></h2>
			<p class="bajada"><?php echo esc_html( $dgm_linea->description ); ?></p>
		</div>
		<div class="rejilla rejilla--3">
			<?php
			foreach ( dgm_servicios( $dgm_linea ) as $dgm_s ) {
				echo dgm_tarjeta( $dgm_s ); // phpcs:ignore
			}
			?>
		</div>
	</div>
</section>
<?php endforeach; ?>

<?php
echo dgm_cierre(); // phpcs:ignore
get_footer();
