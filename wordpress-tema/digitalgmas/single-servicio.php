<?php
/**
 * FICHA DE SERVICIO (una para cada servicio del menú «Servicios»).
 * Dirección: /servicio/<nombre>/
 *
 * @package digitalgmas
 */

defined( 'ABSPATH' ) || exit;
get_header();

while ( have_posts() ) :
	the_post();
	$dgm_post    = get_post();
	$dgm_linea   = dgm_linea_de( $dgm_post );
	$dgm_slug    = $dgm_post->post_name;
	$dgm_bajada  = get_post_meta( $dgm_post->ID, 'dgm_bajada', true );
	$dgm_foto    = get_post_thumbnail_id( $dgm_post );
	$dgm_franja  = (int) get_post_meta( $dgm_post->ID, 'dgm_franja', true );
	$dgm_galeria = array_filter( array_map( 'absint', explode( ',', (string) get_post_meta( $dgm_post->ID, 'dgm_galeria', true ) ) ) );
	$dgm_lista   = array_filter( array_map( 'trim', explode( "\n", (string) get_post_meta( $dgm_post->ID, 'dgm_lista', true ) ) ) );
	$dgm_enlace  = get_post_meta( $dgm_post->ID, 'dgm_enlace_url', true );
	$dgm_ruta    = array( array( 'Servicios', home_url( '/nuestros-servicios/' ) ) );
	if ( $dgm_linea ) {
		$dgm_ruta[] = array( $dgm_linea->name, home_url( '/nuestros-servicios/#' . $dgm_linea->slug ) );
	}
	$dgm_ruta[] = array( dgm_nombre_menu( $dgm_post ) );

	echo dgm_migas( $dgm_ruta ); // phpcs:ignore
	?>

	<section class="cabeza-pagina">
		<div class="contenedor<?php echo $dgm_foto ? ' dividido cabeza-pagina--dividida' : ''; ?>">
			<div>
				<?php if ( $dgm_linea ) : ?><p class="antetitulo"><?php echo esc_html( $dgm_linea->name ); ?></p><?php endif; ?>
				<h1><?php the_title(); ?></h1>
				<?php if ( $dgm_bajada ) : ?><p class="bajada"><?php echo esc_html( $dgm_bajada ); ?></p><?php endif; ?>
				<div class="acciones">
					<a class="boton boton--principal" href="<?php echo esc_url( dgm_url_contacto( $dgm_slug ) ); ?>">Solicitar cotización <?php echo dgm_icono( 'arrow-right' ); // phpcs:ignore ?></a>
					<?php echo dgm_boton_whatsapp(); // phpcs:ignore ?>
				</div>
			</div>
			<?php if ( $dgm_foto ) : ?>
			<div class="marco servicio__imagen">
				<?php echo dgm_imagen( $dgm_foto, '(min-width: 56rem) 48vw, 92vw', array( 'prioridad' => true ) ); // phpcs:ignore ?>
			</div>
			<?php endif; ?>
		</div>
	</section>

	<?php if ( ! $dgm_foto && $dgm_franja ) : ?>
	<div class="contenedor">
		<div class="marco servicio__imagen servicio__imagen--banda">
			<?php echo dgm_imagen( $dgm_franja, '(min-width: 75rem) 1200px, 92vw', array( 'prioridad' => true, 'alt' => '', 'tamano' => 'full' ) ); // phpcs:ignore ?>
		</div>
	</div>
	<?php endif; ?>

	<section class="seccion" aria-label="Descripción del servicio">
		<div class="contenedor servicio__cuerpo">
			<div class="prosa">
				<?php the_content(); ?>

				<?php if ( $dgm_lista ) : ?>
				<h2><?php echo esc_html( get_post_meta( $dgm_post->ID, 'dgm_lista_titulo', true ) ?: 'Incluye' ); ?></h2>
				<ul class="lista-check">
					<?php foreach ( $dgm_lista as $dgm_item ) : ?>
					<li><?php echo dgm_icono( 'check' ); // phpcs:ignore ?><span><?php echo esc_html( $dgm_item ); ?></span></li>
					<?php endforeach; ?>
				</ul>
				<?php endif; ?>

				<?php if ( $dgm_galeria ) : ?>
				<div class="galeria <?php echo count( $dgm_galeria ) > 2 ? 'galeria--3' : 'galeria--2'; ?>">
					<?php foreach ( $dgm_galeria as $dgm_id ) : ?>
					<div class="marco"><?php echo dgm_imagen( $dgm_id, '(min-width: 64rem) 420px, (min-width: 40rem) 45vw, 92vw', array( 'tamano' => 'medium_large' ) ); // phpcs:ignore ?></div>
					<?php endforeach; ?>
				</div>
				<?php endif; ?>
			</div>

			<aside class="ficha" aria-labelledby="titulo-ficha">
				<h2 id="titulo-ficha">¿Te interesa este servicio?</h2>
				<p>Cuéntanos qué necesita tu biblioteca y te enviamos una cotización.</p>
				<div class="acciones">
					<a class="boton boton--principal" href="<?php echo esc_url( dgm_url_contacto( $dgm_slug ) ); ?>">Solicitar cotización</a>
					<?php echo dgm_boton_whatsapp(); // phpcs:ignore ?>
				</div>
				<?php if ( $dgm_enlace ) : ?>
				<a class="ficha__externo enlace-flecha" href="<?php echo esc_url( $dgm_enlace ); ?>" target="_blank" rel="noopener"><?php echo esc_html( get_post_meta( $dgm_post->ID, 'dgm_enlace_texto', true ) ?: 'Más información' ) . ' ' . dgm_icono( 'arrow-up-right' ); // phpcs:ignore ?><span class="solo-lectores"> (se abre en una pestaña nueva)</span></a>
				<?php endif; ?>
			</aside>
		</div>
	</section>

	<?php
	$dgm_otros = $dgm_linea ? dgm_servicios( $dgm_linea, $dgm_post->ID ) : array();
	if ( $dgm_otros ) :
		?>
	<section class="seccion seccion--blanca" aria-labelledby="titulo-otros">
		<div class="contenedor">
			<div class="encabezado revelar">
				<p class="antetitulo"><?php echo esc_html( $dgm_linea->name ); ?></p>
				<h2 id="titulo-otros">Otros servicios de esta línea</h2>
			</div>
			<div class="rejilla rejilla--3">
				<?php
				foreach ( $dgm_otros as $dgm_otro ) {
					echo dgm_tarjeta( $dgm_otro ); // phpcs:ignore
				}
				?>
			</div>
		</div>
	</section>
		<?php
	endif;

	echo dgm_cierre( $dgm_slug ); // phpcs:ignore
endwhile;

get_footer();
