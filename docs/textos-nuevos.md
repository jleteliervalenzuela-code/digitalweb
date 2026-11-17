# Textos nuevos (no existían en el sitio anterior)

Todo el resto del contenido viene del sitio WordPress. Estos textos se redactaron porque el diseño los necesita; revísalos y cámbialos en el archivo indicado.

| Dónde aparece | Texto | Archivo y campo |
|---|---|---|
| Portada, título principal (h1) | «Consultoría, tecnología y digitalización para bibliotecas» | `src/_data/sitio.json` → `inicio.titulo` |
| Portada, bajada del título | «Somos una empresa de consultoría formada por bibliotecarios documentalistas y distribuidor de Bibliotheca en Chile.» (une frases de Quiénes somos y del slider) | `src/_data/sitio.json` → `inicio.bajada` |
| Botones | «Solicitar cotización», «Escribir por WhatsApp», «Ver servicio», «Ver todos los servicios», «Conocer el equipo», «Enviar solicitud» | plantillas en `src/` |
| Formulario | Etiquetas de los campos nuevos (Institución, Cargo, Servicio de interés) y mensajes de confirmación y error | `src/contacto.njk` y `src/assets/js/sitio.js` |
| Títulos de bloques | «Qué hacemos», «Tres líneas de servicio», «Bibliotecarios documentalistas al servicio de tu biblioteca», «Hablemos de tu biblioteca», «Otros servicios de esta línea» | plantillas en `src/` |
| Portada, dato bajo los botones | «19 instituciones confían en nosotros» (el número se calcula solo con la cantidad de logos de `clientes.json`) | `src/index.njk` |
| Fichas de servicio, bloque lateral | «¿Te interesa este servicio?» / «Cuéntanos qué necesita tu biblioteca y te enviamos una cotización.» | `src/servicio.njk` |
| Contacto, título y bajada | «Solicita una cotización» / «Cuéntanos qué necesita tu biblioteca y te responderemos a la brevedad.» | `src/contacto.njk` |
| Contacto, nota de privacidad | «Tu mensaje llega por correo a Digital G+ a través del servicio externo FormSubmit. Usaremos tus datos solo para responder esta solicitud.» | `src/contacto.njk` |
| Página 404 y página de gracias | Títulos, bajadas y botones | `src/404.njk`, `src/contacto/gracias.njk` |
| Pie | «Bibliotheca, cloudLibrary, remoteLocker y open+ son marcas de sus respectivos dueños.» | `src/_includes/parciales/pie.njk` |

Las bajadas de las tres líneas de servicio reutilizan los textos del slider anterior:
- Digitalización: «Grupo de profesionales interdisciplinarios en gestión documental y bibliográfica.»
- Productos Bibliotheca: «Somos distribuidor de Bibliotheca en Chile.»
- Plataformas y productos con IA: «Súmate al cambio y adopta las herramientas de transformación digital.»
