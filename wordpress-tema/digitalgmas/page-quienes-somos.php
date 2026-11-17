<?php
/**
 * QUIÉNES SOMOS
 * El texto es el contenido de la página (Páginas → Quiénes somos).
 * Misión, visión y equipo: Apariencia → Personalizar → Digital G+ → Quiénes somos.
 *
 * @package digitalgmas
 */

defined( 'ABSPATH' ) || exit;
get_header();
the_post();
echo dgm_migas( array( array( 'Quiénes somos' ) ) ); // phpcs:ignore

$dgm_bloques = array(
	'mision' => array( 'Misión', 'Misión. El sitio anterior no tenía este texto.' ),
	'vision' => array( 'Visión', 'Visión. El sitio anterior no tenía este texto.' ),
	'equipo' => array( 'Equipo', 'Equipo: nombres, cargos y fotos de los socios, si se quieren mostrar.' ),
);
$dgm_hay_bloques = false;
foreach ( $dgm_bloques as $dgm_clave => $dgm_b ) {
	if ( dgm_opcion( $dgm_clave ) || dgm_opcion( 'mostrar_pendiente' ) ) {
		$dgm_hay_bloques = true;
	}
}
?>

<section class="cabeza-pagina">
	<div class="contenedor">
		<p class="antetitulo">Digital G+</p>
		<h1><?php the_title(); ?></h1>
	</div>
</section>

<section class="seccion seccion--sin-arriba" aria-label="Presentación">
	<div class="contenedor dividido">
		<div class="prosa">
			<?php the_content(); ?>
			<div class="acciones">
				<a class="boton boton--principal" href="<?php echo esc_url( home_url( '/nuestros-servicios/' ) ); ?>">Ver servicios</a>
			</div>
		</div>
		<div class="marco marco--cuadrado">
			<?php echo dgm_imagen( dgm_opcion( 'nosotros_imagen' ), '(min-width: 56rem) 50vw, 92vw', array( 'prioridad' => true ) ); // phpcs:ignore ?>
		</div>
	</div>
</section>

<?php if ( $dgm_hay_bloques ) : ?>
<section class="seccion seccion--blanca" aria-label="Misión, visión y equipo">
	<div class="contenedor rejilla rejilla--3">
		<?php
		foreach ( $dgm_bloques as $dgm_clave => $dgm_b ) {
			$dgm_texto = dgm_opcion( $dgm_clave );
			if ( $dgm_texto ) {
				echo '<div><h2 class="titulo-bloque">' . esc_html( $dgm_b[0] ) . '</h2>' . dgm_parrafos( $dgm_texto ) . '</div>'; // phpcs:ignore
			} else {
				echo dgm_pendiente( $dgm_b[1] ); // phpcs:ignore
			}
		}
		?>
	</div>
</section>
<?php endif; ?>

<section class="seccion oscuro" aria-labelledby="titulo-partner">
	<div class="contenedor encabezado encabezado--centro encabezado--solo revelar">
		<img class="banda-partner__logo banda-partner__logo--centro" src="<?php echo esc_url( DGM_URI . '/assets/img/marca/bibliotheca-blanco.png' ); ?>" alt="Bibliotheca" width="620" height="99" loading="lazy">
		<h2 id="titulo-partner"><?php echo esc_html( dgm_opcion( 'partner_titulo' ) ); ?></h2>
		<div class="acciones">
			<a class="boton boton--claro" href="<?php echo esc_url( home_url( '/nuestros-servicios/#productos-bibliotheca' ) ); ?>">Ver productos Bibliotheca <?php echo dgm_icono( 'arrow-right' ); // phpcs:ignore ?></a>
		</div>
	</div>
</section>

<?php
echo dgm_cierre(); // phpcs:ignore
get_footer();
