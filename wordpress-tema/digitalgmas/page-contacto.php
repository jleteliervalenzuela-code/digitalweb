<?php
/**
 * CONTACTO
 * El formulario envía los mensajes a través de FormSubmit (dirección en
 * Apariencia → Personalizar → Digital G+ → Formulario). La validación y
 * el envío sin recargar están en assets/js/sitio.js. Sin JavaScript el
 * formulario también funciona y vuelve a /contacto/gracias/.
 *
 * @package digitalgmas
 */

defined( 'ABSPATH' ) || exit;
get_header();
echo dgm_migas( array( array( 'Contacto' ) ) ); // phpcs:ignore
$dgm_correo = dgm_opcion( 'correo' );
?>

<section class="cabeza-pagina">
	<div class="contenedor">
		<p class="antetitulo">Contacto</p>
		<h1>Solicita una cotización</h1>
		<p class="bajada">Cuéntanos qué necesita tu biblioteca y te responderemos a la brevedad.</p>
	</div>
</section>

<section class="seccion seccion--sin-arriba" aria-label="Formulario y canales de contacto">
	<div class="contenedor contacto">
		<form class="formulario" action="<?php echo esc_url( dgm_opcion( 'form_accion' ) ); ?>" method="POST" novalidate data-formulario>
			<input type="hidden" name="_subject" value="<?php echo esc_attr( dgm_opcion( 'form_asunto' ) ); ?>">
			<input type="hidden" name="_template" value="table">
			<input type="hidden" name="_captcha" value="false">
			<input type="hidden" name="_next" value="<?php echo esc_url( home_url( '/contacto/gracias/' ) ); ?>">
			<div class="trampa" aria-hidden="true">
				<label for="campo-web">No llenar este campo</label>
				<input type="text" id="campo-web" name="_honey" tabindex="-1" autocomplete="off">
			</div>

			<div class="campos">
				<div class="campo">
					<label for="nombre">Nombre</label>
					<input id="nombre" name="nombre" type="text" autocomplete="name" required maxlength="120" aria-describedby="error-nombre">
					<span class="campo__error" id="error-nombre" aria-live="polite"></span>
				</div>
				<div class="campo">
					<label for="correo">Correo electrónico</label>
					<input id="correo" name="email" type="email" autocomplete="email" inputmode="email" spellcheck="false" required maxlength="160" placeholder="nombre@institucion.cl" aria-describedby="error-correo">
					<span class="campo__error" id="error-correo" aria-live="polite"></span>
				</div>
				<div class="campo">
					<label for="institucion">Institución <span class="opcional">(opcional)</span></label>
					<input id="institucion" name="institucion" type="text" autocomplete="organization" maxlength="160">
				</div>
				<div class="campo">
					<label for="cargo">Cargo <span class="opcional">(opcional)</span></label>
					<input id="cargo" name="cargo" type="text" autocomplete="organization-title" maxlength="120">
				</div>
				<div class="campo">
					<label for="telefono">Teléfono <span class="opcional">(opcional)</span></label>
					<input id="telefono" name="telefono" type="tel" autocomplete="tel" inputmode="tel" maxlength="30" placeholder="+56 9 …">
				</div>
				<div class="campo">
					<label for="servicio">Servicio de interés <span class="opcional">(opcional)</span></label>
					<select id="servicio" name="servicio">
						<option value="">Selecciona un servicio</option>
						<?php foreach ( dgm_lineas() as $dgm_linea ) : ?>
						<optgroup label="<?php echo esc_attr( $dgm_linea->name ); ?>">
							<?php foreach ( dgm_servicios( $dgm_linea ) as $dgm_s ) : ?>
							<option value="<?php echo esc_attr( get_the_title( $dgm_s ) ); ?>" data-slug="<?php echo esc_attr( $dgm_s->post_name ); ?>"><?php echo esc_html( dgm_nombre_menu( $dgm_s ) ); ?></option>
							<?php endforeach; ?>
						</optgroup>
						<?php endforeach; ?>
						<option value="Otro">Otro</option>
					</select>
				</div>
				<div class="campo campo--ancho">
					<label for="consulta">Consulta</label>
					<textarea id="consulta" name="consulta" required minlength="10" maxlength="4000" aria-describedby="error-consulta"></textarea>
					<span class="campo__error" id="error-consulta" aria-live="polite"></span>
				</div>
			</div>

			<div class="formulario__pie">
				<p class="formulario__nota">Tu mensaje llega por correo a Digital G+ a través del servicio externo FormSubmit. Usaremos tus datos solo para responder esta solicitud.</p>
				<button class="boton boton--principal" type="submit">Enviar solicitud <?php echo dgm_icono( 'arrow-right' ); // phpcs:ignore ?></button>
			</div>
			<div class="formulario__estado" role="status" aria-live="polite" data-estado></div>
		</form>

		<div class="canales">
			<a class="canal" href="<?php echo esc_url( dgm_url_whatsapp() ); ?>" target="_blank" rel="noopener">
				<span class="canal__icono canal__icono--wa"><?php echo dgm_icono( 'whatsapp' ); // phpcs:ignore ?></span>
				<span><strong>WhatsApp</strong><span><?php echo esc_html( dgm_opcion( 'telefono' ) ); ?></span><span class="solo-lectores"> (se abre en una pestaña nueva)</span></span>
			</a>
			<a class="canal" href="tel:<?php echo esc_attr( dgm_tel() ); ?>">
				<span class="canal__icono"><?php echo dgm_icono( 'phone' ); // phpcs:ignore ?></span>
				<span><strong>Teléfono</strong><span><?php echo esc_html( dgm_opcion( 'telefono' ) ); ?></span></span>
			</a>
			<a class="canal" href="mailto:<?php echo esc_attr( $dgm_correo ); ?>">
				<span class="canal__icono"><?php echo dgm_icono( 'mail' ); // phpcs:ignore ?></span>
				<span><strong>Correo</strong><span><?php echo esc_html( $dgm_correo ); ?></span></span>
			</a>
			<?php
			$dgm_dir = dgm_opcion( 'direccion' );
			$dgm_hor = dgm_opcion( 'horario' );
			if ( $dgm_dir || $dgm_hor ) {
				echo '<div class="canal canal--texto"><span>';
				if ( $dgm_dir ) {
					echo '<strong>Dirección</strong>' . dgm_parrafos( $dgm_dir ); // phpcs:ignore
				}
				if ( $dgm_hor ) {
					echo '<strong>Horario</strong>' . dgm_parrafos( $dgm_hor ); // phpcs:ignore
				}
				echo '</span></div>';
			} else {
				echo dgm_pendiente( 'Dirección y horario de atención, si se quieren mostrar.' ); // phpcs:ignore
			}
			?>
		</div>
	</div>
</section>

<?php
get_footer();
