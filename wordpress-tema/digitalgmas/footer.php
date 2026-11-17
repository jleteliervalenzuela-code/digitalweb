<?php
/**
 * Pie del sitio (una sola vez para todas las páginas).
 *
 * @package digitalgmas
 */

defined( 'ABSPATH' ) || exit;
$dgm_correo = dgm_opcion( 'correo' );
?>
</main>

<footer class="pie">
	<div class="contenedor">
		<div class="pie__rejilla">
			<div>
				<img class="pie__logo" src="<?php echo esc_url( DGM_URI . '/assets/img/marca/logo-blanco.png' ); ?>" alt="Digital G+" width="350" height="150" loading="lazy">
				<p><?php echo esc_html( dgm_opcion( 'partner_titulo' ) ); ?>.</p>
			</div>
			<?php foreach ( dgm_lineas() as $dgm_linea ) : ?>
			<div>
				<p class="pie__titulo"><?php echo esc_html( $dgm_linea->name ); ?></p>
				<ul>
					<?php foreach ( dgm_servicios( $dgm_linea ) as $dgm_s ) : ?>
					<li><a href="<?php echo esc_url( get_permalink( $dgm_s ) ); ?>"><?php echo esc_html( dgm_nombre_menu( $dgm_s ) ); ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
			<?php endforeach; ?>
		</div>

		<div class="pie__rejilla pie__rejilla--contacto">
			<div>
				<p class="pie__titulo">Contacto</p>
				<ul>
					<li><a href="mailto:<?php echo esc_attr( $dgm_correo ); ?>"><?php echo dgm_icono( 'mail' ) . esc_html( $dgm_correo ); // phpcs:ignore ?></a></li>
					<li><a href="tel:<?php echo esc_attr( dgm_tel() ); ?>"><?php echo dgm_icono( 'phone' ) . esc_html( dgm_opcion( 'telefono' ) ); // phpcs:ignore ?></a></li>
				</ul>
			</div>
			<div>
				<p class="pie__titulo">Sitio</p>
				<ul>
					<li><a href="<?php echo esc_url( home_url( '/quienes-somos/' ) ); ?>">Quiénes somos</a></li>
					<li><a href="<?php echo esc_url( home_url( '/nuestros-servicios/' ) ); ?>">Servicios</a></li>
					<li><a href="<?php echo esc_url( home_url( '/nuestros-clientes/' ) ); ?>">Clientes</a></li>
					<li><a href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>">Contacto</a></li>
				</ul>
			</div>
		</div>

		<div class="pie__base">
			<p>© <?php echo esc_html( wp_date( 'Y' ) ); ?> Digital G+. Todos los derechos reservados.</p>
			<p>Bibliotheca, cloudLibrary, remoteLocker y open+ son marcas de sus respectivos dueños.</p>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
