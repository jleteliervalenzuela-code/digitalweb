<?php
/**
 * Plantilla de respaldo. El sitio no tiene blog: cualquier vista que no
 * tenga plantilla propia usa este listado simple.
 *
 * @package digitalgmas
 */

defined( 'ABSPATH' ) || exit;
get_header();
?>
<section class="cabeza-pagina">
	<div class="contenedor">
		<h1><?php echo esc_html( wp_get_document_title() ); ?></h1>
	</div>
</section>
<section class="seccion seccion--sin-arriba">
	<div class="contenedor prosa">
		<?php if ( have_posts() ) : ?>
			<ul>
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
			<?php endwhile; ?>
			</ul>
		<?php else : ?>
			<p>No hay contenido para mostrar.</p>
		<?php endif; ?>
	</div>
</section>
<?php
get_footer();
