<?php
/**
 * PORTADA
 * Textos e imágenes: Apariencia → Personalizar → Digital G+ → Portada.
 * Líneas y servicios: menú «Servicios». Logos: menú «Clientes».
 *
 * @package digitalgmas
 */

defined( 'ABSPATH' ) || exit;
get_header();
$dgm_lineas = dgm_lineas();
?>

<section class="hero" aria-labelledby="titulo-inicio">
	<div class="contenedor dividido">
		<div class="hero__texto">
			<p class="antetitulo"><?php echo esc_html( dgm_opcion( 'antetitulo' ) ); ?></p>
			<h1 id="titulo-inicio"><?php echo esc_html( dgm_opcion( 'titulo' ) ); ?></h1>
			<p class="bajada"><?php echo esc_html( dgm_opcion( 'bajada' ) ); ?></p>
			<div class="acciones">
				<a class="boton boton--principal" href="<?php echo esc_url( dgm_url_contacto() ); ?>">Solicitar cotización <?php echo dgm_icono( 'arrow-right' ); // phpcs:ignore ?></a>
				<?php echo dgm_boton_whatsapp(); // phpcs:ignore ?>
			</div>
			<div class="dato-hero">
				<img src="<?php echo esc_url( DGM_URI . '/assets/img/marca/partner-bibliotheca.png' ); ?>" alt="Partner de Bibliotheca" width="272" height="124">
				<span><?php echo count( dgm_clientes() ); ?> instituciones confían en nosotros</span>
			</div>
		</div>
		<div class="marco hero__imagen">
			<?php echo dgm_imagen( dgm_opcion( 'hero_imagen' ), '(min-width: 56rem) 50vw, 92vw', array( 'prioridad' => true ) ); // phpcs:ignore ?>
		</div>
	</div>
</section>

<section class="seccion seccion--blanca" id="servicios" aria-labelledby="titulo-servicios">
	<div class="contenedor">
		<div class="encabezado encabezado--centro revelar">
			<p class="antetitulo">Qué hacemos</p>
			<h2 id="titulo-servicios">Tres líneas de servicio</h2>
		</div>

		<div class="pestanas" data-pestanas>
			<div class="pestanas__lista" role="tablist" aria-label="Líneas de servicio">
				<?php foreach ( $dgm_lineas as $i => $dgm_linea ) : ?>
				<button class="pestana" type="button" role="tab" id="pestana-<?php echo esc_attr( $dgm_linea->slug ); ?>" aria-controls="panel-<?php echo esc_attr( $dgm_linea->slug ); ?>" aria-selected="<?php echo 0 === $i ? 'true' : 'false'; ?>" tabindex="<?php echo 0 === $i ? '0' : '-1'; ?>"><?php echo esc_html( $dgm_linea->name ); ?></button>
				<?php endforeach; ?>
			</div>

			<?php foreach ( $dgm_lineas as $i => $dgm_linea ) : ?>
			<div class="pestanas__panel" role="tabpanel" id="panel-<?php echo esc_attr( $dgm_linea->slug ); ?>" aria-labelledby="pestana-<?php echo esc_attr( $dgm_linea->slug ); ?>"<?php echo $i ? ' data-oculto' : ''; ?>>
				<div class="linea">
					<div class="marco linea__imagen">
						<?php echo dgm_imagen( get_term_meta( $dgm_linea->term_id, 'dgm_imagen', true ), '(min-width: 56rem) 55vw, 92vw' ); // phpcs:ignore ?>
					</div>
					<div>
						<h3><?php echo esc_html( $dgm_linea->name ); ?></h3>
						<p class="bajada"><?php echo esc_html( $dgm_linea->description ); ?></p>
						<ul class="linea__lista">
							<?php foreach ( dgm_servicios( $dgm_linea ) as $dgm_s ) : ?>
							<li><a href="<?php echo esc_url( get_permalink( $dgm_s ) ); ?>"><?php echo esc_html( get_the_title( $dgm_s ) ) . ' ' . dgm_icono( 'arrow-right' ); // phpcs:ignore ?></a></li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="seccion oscuro" aria-labelledby="titulo-partner">
	<div class="contenedor dividido">
		<div class="revelar">
			<img class="banda-partner__logo" src="<?php echo esc_url( DGM_URI . '/assets/img/marca/bibliotheca-blanco.png' ); ?>" alt="Bibliotheca" width="620" height="99" loading="lazy">
			<h2 id="titulo-partner"><?php echo esc_html( dgm_opcion( 'partner_titulo' ) ); ?></h2>
			<div class="acciones">
				<a class="boton boton--claro" href="<?php echo esc_url( home_url( '/nuestros-servicios/#productos-bibliotheca' ) ); ?>">Ver productos Bibliotheca <?php echo dgm_icono( 'arrow-right' ); // phpcs:ignore ?></a>
			</div>
		</div>
		<div class="banda-partner__fotos">
			<?php foreach ( array( 'partner_foto_1', 'partner_foto_2' ) as $n => $dgm_clave ) : ?>
			<div class="marco revelar revelar--<?php echo (int) $n + 2; ?>">
				<?php echo dgm_imagen( dgm_opcion( $dgm_clave ), '(min-width: 56rem) 26vw, 45vw' ); // phpcs:ignore ?>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="seccion" aria-labelledby="titulo-nosotros">
	<div class="contenedor dividido dividido--invertido">
		<div class="revelar">
			<p class="antetitulo">Quiénes somos</p>
			<h2 id="titulo-nosotros"><?php echo esc_html( dgm_opcion( 'nosotros_titulo' ) ); ?></h2>
			<p class="bajada"><?php echo esc_html( dgm_opcion( 'nosotros_bajada' ) ); ?></p>
			<div class="acciones">
				<a class="boton boton--secundario" href="<?php echo esc_url( home_url( '/quienes-somos/' ) ); ?>">Más sobre Digital G+</a>
			</div>
		</div>
		<div class="marco marco--cuadrado revelar revelar--2">
			<?php echo dgm_imagen( dgm_opcion( 'nosotros_imagen' ), '(min-width: 56rem) 45vw, 92vw' ); // phpcs:ignore ?>
		</div>
	</div>
</section>

<section class="seccion seccion--blanca" aria-labelledby="titulo-clientes">
	<div class="contenedor">
		<div class="encabezado encabezado--centro revelar">
			<p class="antetitulo">Clientes</p>
			<h2 id="titulo-clientes"><?php echo esc_html( dgm_opcion( 'clientes_titulo' ) ); ?></h2>
		</div>
		<?php echo dgm_logos(); // phpcs:ignore ?>
	</div>
</section>

<?php
echo dgm_cierre(); // phpcs:ignore
get_footer();
