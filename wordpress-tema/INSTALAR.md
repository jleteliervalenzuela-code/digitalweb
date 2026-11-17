# Instalar el sitio de Digital G+ en WordPress

El archivo `digitalgmas.zip` es un **tema de WordPress a medida**. Contiene el diseño completo y todo el contenido del sitio (páginas, 15 servicios, 19 clientes y 54 imágenes). No necesita plugins.

Tiempo total: unos 20 minutos si el servidor tiene un instalador de WordPress.

---

## 1. Requisitos del servidor

Los que recomienda WordPress.org:

- PHP 8.3 o superior (funciona desde PHP 8.0)
- MariaDB 10.11 o superior, o MySQL 8.0 o superior
- HTTPS (certificado SSL)
- Apache con `mod_rewrite` o Nginx

Si no sabes qué tiene el servidor, pregúntale al proveedor por esos cuatro puntos.

---

## 2. Instalar WordPress

**Si el servidor tiene panel (cPanel, Plesk, DirectAdmin):** busca el instalador de aplicaciones (Softaculous, Installatron o «WordPress Toolkit») y elige WordPress. Usa estos datos:
- Dominio: el definitivo (`digitalgmas.cl`) o uno temporal para probar (ver paso 7).
- Carpeta: déjala vacía, para que quede en la raíz del dominio.
- Idioma: Español (Chile).
- Usuario administrador: uno distinto de «admin», con una contraseña fuerte.

**Si es un servidor sin panel (VPS):** descarga WordPress en español desde [es-cl.wordpress.org](https://es-cl.wordpress.org/), crea una base de datos y un usuario en MySQL/MariaDB, sube los archivos y abre el sitio en el navegador para completar el asistente.

---

## 3. Subir el tema

1. Entra al panel de WordPress (`tu-sitio/wp-admin`).
2. Ve a **Apariencia → Temas → Añadir tema → Subir tema**.
3. Elige `digitalgmas.zip` y pulsa **Instalar ahora**.
4. Pulsa **Activar**.

**Si aparece «El archivo subido excede la directiva upload_max_filesize»:** el servidor limita las subidas a menos de 5 MB. Dos soluciones:
- Pide al proveedor que suba `upload_max_filesize` y `post_max_size` a 16 MB o más.
- O descomprime `digitalgmas.zip` en tu computador y sube la carpeta `digitalgmas` completa a `wp-content/themes/` con el administrador de archivos del panel o por FTP. Luego actívalo en **Apariencia → Temas**.

---

## 4. Importar el contenido

Al activar el tema se abre sola la pantalla **Digital G+ → Importar contenido**.

1. Pulsa **Importar contenido**.
2. Espera a que la barra llegue al final y aparezca **«¡Listo!»** (en las pruebas tardó 11 segundos; en un hosting compartido puede tardar uno o dos minutos). No cierres la pestaña.
3. Pulsa **Ver el sitio**.

La importación también:
- deja los enlaces permanentes en «Nombre de la entrada», para que las direcciones sean las mismas del sitio anterior (`/servicio/lockers-inteligentes/`, etc.);
- asigna la portada;
- cierra los comentarios;
- envía a la papelera la entrada «¡Hola, mundo!» y la página de ejemplo de WordPress.

Si se interrumpe, vuelve a pulsar el botón: continúa sin duplicar nada.

---

## 5. Ajustar textos y datos

**Apariencia → Personalizar → Digital G+** tiene cuatro secciones:

| Sección | Qué se edita |
|---|---|
| Portada | Descripción para Google, antetítulo, título, bajada, imagen principal, fotos de la banda Bibliotheca, bloque Quiénes somos, título de clientes |
| Quiénes somos | Misión, visión, equipo y la casilla **Mostrar recuadros [PENDIENTE]** |
| Contacto y WhatsApp | Correo, teléfono, número y mensaje de WhatsApp, dirección, horario |
| Formulario y Google Tag Manager | Dirección de envío de FormSubmit, asunto del correo, ID de GTM (`GTM-PCLFRV6`) |

**Antes de lanzar, desmarca «Mostrar recuadros [PENDIENTE]»** (o completa misión, visión, equipo, dirección y horario: al tener texto, los recuadros se reemplazan solos por el contenido).

---

## 6. Editar el contenido del día a día

| Para… | Ve a… |
|---|---|
| Cambiar el texto, las fotos o la lista de un servicio | **Servicios** → el servicio. Texto arriba; bajada, lista, enlace a Bibliotheca, galería y franja en «Datos del servicio»; foto principal a la derecha |
| Agregar un servicio | **Servicios → Añadir servicio**. Marca su línea a la derecha y ponle un número en «Orden». Aparece solo en el menú, el pie, la portada, Servicios y el formulario |
| Agregar o quitar un cliente | **Clientes**. El título es el nombre de la institución; el logo va en «Logo» (formato de los actuales: 850 × 464 px, fondo blanco) |
| Cambiar el nombre, la frase o la imagen de una línea | **Servicios → Líneas** |
| Cambiar el texto de Quiénes somos | **Páginas → Quiénes somos** |

**Para no romper el diseño:** no cambies de tema y no instales constructores visuales como Elementor o Divi.

---

## 7. Dominio y lanzamiento

- **Recomendado:** instalar WordPress directamente con `digitalgmas.cl` y apuntar el dominio al servidor cuando todo esté revisado. Mientras el DNS no se cambie, el WordPress actual de iP21 sigue funcionando.
- **Si instalas primero en una dirección temporal** (por ejemplo `nuevo.digitalgmas.cl` o la IP del servidor), al lanzar cambia las dos direcciones en **Ajustes → Generales** por `https://digitalgmas.cl`. El tema guarda las imágenes por su número en la biblioteca y no por su dirección, así que no hay que reemplazar nada más.
- Activa HTTPS en el servidor antes de lanzar.

Las direcciones antiguas que ya no existen redirigen solas (301) a las nuevas: `/servicio/biblioteca-agentica/`, `/servicio/buscador-de-bibliografias/`, `/category/…`, `/servicio/`, `/pagina-de-ejemplo/` y `/super-simple-slider/slider-escritorio/`. La lista está en `inc/redirecciones.php`.

---

## 8. Formulario de contacto

El formulario usa FormSubmit, igual que la versión en GitHub. Después de lanzar:

1. Envía un mensaje de prueba desde **Contacto**.
2. Confirma el correo que FormSubmit enviará a `contacto@digitalgmas.cl`. Hasta entonces los mensajes no se entregan.
3. Copia la cadena aleatoria que te entrega FormSubmit en **Personalizar → Digital G+ → Formulario** (`https://formsubmit.co/<cadena>`), para que el correo no quede visible en el código.

---

## 9. Mantenimiento

- **Actualiza WordPress** cuando el panel lo indique (o activa las actualizaciones automáticas en **Escritorio → Actualizaciones**).
- **Respaldos:** pide al proveedor del servidor respaldos diarios de archivos y base de datos, o configúralos en el panel.
- **Google Tag Manager** no se carga cuando hay una sesión de WordPress iniciada, para que tus visitas no cuenten en las estadísticas. Para probarlo, usa una ventana privada.
- El tema no depende de plugins. Si instalas alguno, que sea de seguridad o respaldos, no de diseño.
