<?php
/**
 * Página genérica (para páginas nuevas que se creen en el panel,
 * por ejemplo una política de privacidad).
 *
 * @package digitalgmas
 */

defined( 'ABSPATH' ) || exit;
get_header();
while ( have_posts() ) :
	the_post();
	echo dgm_migas( array( array( get_the_title() ) ) ); // phpcs:ignore
	?>
	<section class="cabeza-pagina">
		<div class="contenedor">
			<h1><?php the_title(); ?></h1>
		</div>
	</section>
	<section class="seccion seccion--sin-arriba">
		<div class="contenedor prosa">
			<?php the_content(); ?>
		</div>
	</section>
	<?php
endwhile;
get_footer();
