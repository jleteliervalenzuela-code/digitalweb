# Digital G+ migra una marca definida y un contenido mínimo

El sitio actual de Digital G+ tiene una identidad cromática y tipográfica completa y recuperable (azul marino `#020d7e`, degradado `#2b36a7 → #0fb9c3`, Kumbh Sans + Heebo), pero casi no tiene contenido propio y su recorrido comercial está roto: los tres botones del slider de portada apuntan a `#` o al dominio de pruebas de la agencia anterior, y ninguna página fuera del pie y del menú invita a contactar ([portada](https://digitalgmas.cl/)). Todo el texto «de marca» migrable cabe en un párrafo de Quiénes somos, tres láminas de slider y 17 fichas de servicio de entre 35 y 150 palabras, dos de ellas duplicadas; las páginas Nuestros Servicios y Nuestros Clientes no tienen ni una frase ([Quiénes somos](https://digitalgmas.cl/quienes-somos/), [archivo de servicios](https://digitalgmas.cl/servicio/)). La marca aparece escrita de seis maneras, las 17 fichas carecen de meta descripción, 18 imágenes de contenido tienen alt vacío y sigue publicada la «Página de ejemplo» de WordPress con un enlace al panel de administración del dominio de pruebas ([página de ejemplo](https://digitalgmas.cl/pagina-de-ejemplo/)). El material gráfico alcanza para tarjetas y columnas (la foto de producto más ancha mide 900 px; el logo es un JPEG de 600×124 sin versión vectorial), no para imágenes a sangre. Las 28 URLs del sitemap están inventariadas con su estado HTTP: 25 responden 200 y las 3 de categoría responden 301. Nada se pierde al apagar WordPress: las 10 imágenes que las fichas cargan desde el dominio de pruebas existen también en `digitalgmas.cl` y ya fueron descargadas. Quedan fuera de esta fase, sin medir, el rendimiento (Lighthouse), el contraste de color, el comportamiento móvil y el aspecto renderizado. Antes de la Fase 2 el dueño debe resolver once puntos, entre ellos qué versión de las fichas duplicadas prevalece, los nombres reales de 19 clientes (ninguno figura como texto en el sitio) y qué vacíos se llenarán con contenido nuevo.

**Convenciones de este informe.** «Literal» significa copiado tal cual del HTML descargado el 16-11-2026, con sus erratas; las erratas se listan aparte en la sección 3.9 y no se corrigen en la transcripción. **[NO VERIFICADO]** marca lo que no se comprobó en el código fuente. **[DEDUCIDO]** marca inferencias. **[PENDIENTE]** marca contenido que el sitio no tiene. Cuando las notas de investigación se contradicen prevalece la extracción del código fuente. El nombre oficial de la marca es «Digital G+»; las demás grafías aparecen aquí solo como cita de lo que hoy está publicado.

## 1. Tres fallas críticas cortan el camino hacia la cotización

El sitio no falla por tecnología sino por abandono editorial: corre sobre WordPress 7.1.4 con el tema `wp-bootstrap-4` y un tema hijo, lleva el crédito de la agencia iP21, sus archivos originales están en la carpeta de mayo de 2023 y los de los tres productos de IA en la de octubre de 2026 (fechas de construcción [DEDUCIDO] de esas carpetas), y entre ambos momentos quedaron enlaces al entorno de pruebas, páginas de muestra, duplicados y cadenas en inglés ([portada](https://digitalgmas.cl/), [hoja de estilo del tema hijo](https://digitalgmas.cl/wp-content/themes/wp-bootstrap-4-child/style.css)). La tabla ordena los hallazgos por severidad. «Crítica» es lo que rompe el recorrido principal o daña la credibilidad a primera vista; «Alta», lo que impide encontrar o entender la oferta; «Media», deuda de calidad que la reconstrucción debe corregir; «Baja», detalles de pulido.

| # | Severidad | Área | Hallazgo | Evidencia |
|---|---|---|---|---|
| 1 | Crítica | Enlaces | Los tres «Ver más» del slider de portada están rotos: uno va a `#` y dos a `digitalgmas.disenositioweb.cl` (dominio de pruebas de la agencia, inaccesible desde el entorno de auditoría; su estado para el público es [NO VERIFICADO]) | [portada](https://digitalgmas.cl/) |
| 2 | Crítica | UX | No existe ninguna llamada a contactar o cotizar en la portada ni en las 17 fichas; el contacto vive solo en el menú y el pie. No hay enlace de WhatsApp en todo el sitio | [portada](https://digitalgmas.cl/), [ficha Auto préstamo](https://digitalgmas.cl/servicio/auto-prestamo/) |
| 3 | Crítica | Contenido / SEO | Sigue publicada e indexable la «Página de ejemplo» de WordPress, con texto de muestra y enlace a `digitalgmas.disenositioweb.cl/wp-admin/` | [página de ejemplo](https://digitalgmas.cl/pagina-de-ejemplo/) |
| 4 | Alta | Contenido | Nuestros Servicios y Nuestros Clientes no tienen ningún párrafo; las 15 tarjetas de servicio son solo título e ícono | [Nuestros Servicios](https://digitalgmas.cl/nuestros-servicios/), [Nuestros Clientes](https://digitalgmas.cl/nuestros-clientes/) |
| 5 | Alta | Contenido | Dos pares de fichas duplicadas con textos casi iguales: `agente-biblioteca` / `biblioteca-agentica` y `buscador-bibliografias` / `buscador-de-bibliografias` | [archivo de servicios](https://digitalgmas.cl/servicio/) |
| 6 | Alta | Marca | Seis grafías de la marca en texto y atributos: «DigitalG», «DigitalG+», «Digital GMAS», «Digital G+», «Digital G +» y «Digital Gmas» | [portada](https://digitalgmas.cl/), [archivo de servicios](https://digitalgmas.cl/servicio/) |
| 7 | Alta | UX | «Lockers inteligentes» no está en el menú (Productos Bibliotheca lista 6 ítems) aunque sí tiene tarjeta y ficha; sus migas de pan la clasifican como «Digitalización» [migas: NO VERIFICADO en código fuente] | [portada](https://digitalgmas.cl/), [ficha Lockers](https://digitalgmas.cl/servicio/lockers-inteligentes/) |
| 8 | Alta | Contenido | La portada muestra 19 logos de clientes; la página Nuestros Clientes, 16 (faltan uandes, iplacex y alba) | [portada](https://digitalgmas.cl/), [Nuestros Clientes](https://digitalgmas.cl/nuestros-clientes/) |
| 9 | Alta | SEO | La portada no tiene h1. Cuatro páginas comparten el mismo title y la misma meta descripción. Las 17 fichas no tienen meta descripción | [portada](https://digitalgmas.cl/), [Contacto](https://digitalgmas.cl/contacto/) |
| 10 | Alta | Accesibilidad | 18 imágenes de contenido con alt vacío: 3 fondos de slider, 3 tarjetas de IA, 3 logos, 3 diagramas de IA, 3 fotos de Lockers y 3 capturas de Portal | [portada](https://digitalgmas.cl/), [ficha Portal](https://digitalgmas.cl/servicio/portal-de-bibliotecas/) |
| 11 | Alta | Enlaces / técnica | 10 imágenes de 7 fichas se cargan desde el dominio de pruebas. Riesgo ya neutralizado: los mismos archivos existen en `digitalgmas.cl/wp-content/uploads/2023/05/` y fueron descargados | [ficha Koha](https://digitalgmas.cl/servicio/koha-instalacion-y-soporte/) |
| 12 | Alta | Contenido | Fichas muy breves y sin cierre comercial; la de Koha describe el software en general y no el servicio de instalación y soporte que anuncia su título | [ficha Koha](https://digitalgmas.cl/servicio/koha-instalacion-y-soporte/) |
| 13 | Media | UX / contenido | Las láminas 2 y 3 del slider no son coherentes: la 2 titula «Digitalización de Bibliografía» y su texto describe al equipo; la 3 habla de portales y enlaza a Koha [DEDUCIDO] | [portada](https://digitalgmas.cl/) |
| 14 | Media | UX | Clasificación dudosa: «Koha: Instalación y soporte» y «Visor de PDF» están bajo «Plataformas y productos con IA» y sus textos no mencionan IA; el slug del visor es `visor-libro-ia` | [ficha Visor](https://digitalgmas.cl/servicio/visor-libro-ia/) |
| 15 | Media | SEO / técnica | Página técnica vacía e indexable `/super-simple-slider/slider-escritorio/`; archivo `/servicio/` con «Archivos: Servicios», «Continue Reading» y «Older Posts»; tres URLs de categoría que responden 301 | [archivo de servicios](https://digitalgmas.cl/servicio/), [sitemap](https://digitalgmas.cl/sitemap_index.xml) |
| 16 | Media | SEO | `og:image` solo en 8 fichas; ninguna en portada ni páginas. `og:locale` figura como `es_ES` pese a `lang="es-CL"` [og:locale: NO VERIFICADO en código fuente] | [portada](https://digitalgmas.cl/) |
| 17 | Media | Accesibilidad | Interfaz en inglés mezclada con español: «Skip to content», «Previous Post / Next Post», «Continue Reading», «Older Posts» | [ficha Estanterías](https://digitalgmas.cl/servicio/estanterias-inteligentes/) |
| 18 | Media | Accesibilidad | Jerarquía de encabezados con saltos: pie en h4 y h6, botón «Más información» como h5 inmediatamente después del h1 | [ficha Antenas](https://digitalgmas.cl/servicio/antenas-de-seguridad-rfid/) |
| 19 | Media | Accesibilidad | Alt erróneos o inútiles: `01_servicio.png` con alt «Quienes Somos», `enac.jpg` con alt «Biblioteca Enac» en la ficha de Koha, y alts que son siglas o nombres de archivo («antena», «sii», «san_agustin») | [portada](https://digitalgmas.cl/) |
| 20 | Media | Marca / técnica | El logo de cabecera es un JPEG de 600×124 px que incluye el sello «partner»; no existe versión vectorial. La imagen de producto más ancha mide 900 px | [portada](https://digitalgmas.cl/) |
| 21 | Media | Técnica | Cinco familias tipográficas cargadas con `@import` bloqueante; PNG pesados (`04_img.png` 990 KB, `img_insumos.png` 869 KB, `01_servicio.png` 580 KB y tres diagramas de 578–760 KB) | [hoja de estilo del tema hijo](https://digitalgmas.cl/wp-content/themes/wp-bootstrap-4-child/style.css) |
| 22 | Media | Técnica / marca | Dependencias de la agencia anterior: flecha «volver arriba» servida desde `ip21.cl` y crédito «Un sitio: iP21» en el pie | [portada](https://digitalgmas.cl/) |
| 23 | Media | UX | Formulario de 4 campos (Nombre, Correo Electrónico, Teléfono, Consulta) sin selector de servicio, institución ni cargo; depende de JavaScript | [Contacto](https://digitalgmas.cl/contacto/) |
| 24 | Media | Contenido | Sin dirección, horario, mapa, redes sociales, política de privacidad ni año en el copyright | [Contacto](https://digitalgmas.cl/contacto/) |
| 25 | Baja | Contenido | Erratas de redacción en la mayoría de las fichas, en Quiénes somos y en el menú (detalle en 3.10) | [ficha Inventarios](https://digitalgmas.cl/servicio/inventarios-y-gestion-de-colecciones/) |
| 26 | Baja | UX | El orden de los servicios en el menú no coincide con el de las tarjetas; los tres ítems padre del menú son anclas a la portada (`/#servicio1..3`), no páginas | [portada](https://digitalgmas.cl/) |
| 27 | Baja | Técnica | Nombres de archivo con erratas (`12_subercasaex.jpg`, `13_porandes.jpg`), dos archivos con prefijo `08_`, diagramas de 2026 guardados en la carpeta `2023/05` | [portada](https://digitalgmas.cl/) |

Dos hallazgos de las lecturas preliminares quedan **descartados** por el código fuente: la ficha patrimonial con barra final responde 200 con su contenido correcto (la anomalía no se reproduce), y el formulario no es de WPForms ni Contact Form 7 sino de Ninja Forms. Tampoco hay Elementor: los plugins detectados son Smart Slider 3, Super Simple Slider, Max Mega Menu, Logo Showcase with Slick Slider, Ninja Forms y Yoast SEO, más jQuery y anime.js desde cdnjs, el contenedor de Google Tag Manager `GTM-PCLFRV6` y reCAPTCHA en Contacto ([Contacto](https://digitalgmas.cl/contacto/)).

**No medido en esta fase:** Lighthouse/PageSpeed, contraste de color, navegación por teclado y foco, comportamiento del menú en móvil, autoplay del slider y aspecto visual renderizado. No hay ninguna cifra de rendimiento y este informe no estima ninguna.

## 2. La identidad se sostiene en dos azules, un turquesa y un degradado

La paleta vive en dos archivos: la hoja de estilo del tema hijo y la del mega menú ([tema hijo](https://digitalgmas.cl/wp-content/themes/wp-bootstrap-4-child/style.css), [mega menú](https://digitalgmas.cl/wp-content/uploads/maxmegamenu/style.css)). El azul marino `#020d7e` es el color dominante por frecuencia y por función: tiñe todos los encabezados, el menú y el botón principal. El celeste `#0096ca` es el color de interacción (hover), y el turquesa `#0fb9c3` cierra el degradado de marca.

### Colores de marca

| Hex | Nombre descriptivo | Uso en el CSS actual | Apariciones |
|---|---|---|---|
| `#020d7e` | Azul marino | Encabezados h1–h6, enlaces del menú, fondo del botón Enviar, fondo del mega menú | 6 en tema hijo + 13 en mega menú |
| `#0096ca` | Celeste | Hover del menú, hover de botones, hover del mega menú | 3 + 8 |
| `#0fb9c3` | Turquesa | Hover de enlaces de tarjetas de servicio; fin del degradado de marca | 6 |
| `#2b36a7` | Azul medio | Inicio del degradado de marca | 5 |
| `#2f2f6f` (una vez `#2f2e6f`) | Índigo | Fondos oscuros: pie y botón «Más información» de las fichas | 3 |
| `#1793c7` | Celeste medio | Hover de enlaces del pie | 2 |
| `#0696cf` | Celeste (variante) | Dos usos puntuales | 2 |
| `#8696a2` | Gris azulado | Texto de migas de pan | 2 |
| `#fafbff` | Blanco azulado | Fondo del body | 1 |
| `#ffffff` | Blanco | Fondos y texto sobre oscuro | 27 |

### Colores auxiliares y colores a descartar

| Hex / valor | Uso | Tratamiento |
|---|---|---|
| `#d0d2d9` | Sombra de imágenes | Auxiliar |
| `#a9dcff`, `#75c4f7` | Bordes claros | Auxiliar |
| `#58cff9` | Un uso | Auxiliar |
| `#109cde` | Un uso en el mega menú | Auxiliar |
| `rgba(27,31,56,0.23)` | Sombras (12 usos) | Auxiliar |
| `#007bff`, `#0069d9`, `#039`, `#32373c` | Valores por defecto de Bootstrap y WordPress | **No son de marca; no conservar** |

### Degradados

| Degradado | Definición exacta | Uso |
|---|---|---|
| De marca | `linear-gradient(to right, #2b36a7, #0fb9c3)` | Líneas decorativas, subrayados y bordes (4 usos) |
| Oscuro azul | `linear-gradient(318deg, rgb(5,2,65) 0%, rgb(9,9,121) 35%, rgb(0,157,255) 100%)` = `#050241 → #090979 → #009dff` | Fondo oscuro |
| Azul-turquesa | `linear-gradient(318deg, rgb(4,41,120) 0%, rgb(15,185,195) 58%, rgb(15,195,163) 100%)` = `#042978 → #0fb9c3 → #0fc3a3` | Fondo |
| Variante por categoría 1 | `#090478 → #0b4ba8 → #05b9c2` | Uso puntual |
| Variante por categoría 2 | `#0722ab → #2242e2 → #cf46fc` | Uso puntual; **único violeta/magenta del sitio** |
| Variante por categoría 3 | `#4b036c → #1793c7 → #08f1c8` | Uso puntual |

A qué categoría corresponde cada variante puntual no quedó registrado en las notas: [NO VERIFICADO].

### Tipografía actual

| Familia | Función | Pesos cargados | Origen |
|---|---|---|---|
| **Kumbh Sans** | Encabezados y menú | 100–900 | Google Fonts |
| **Heebo** | Texto de párrafo | 100–900 | Google Fonts |
| Archivo | Cargada; figura comentada en el CSS como alternativa anterior para encabezados | 500–700 | Google Fonts |
| Montserrat | Cargada | no registrado | Google Fonts |
| Roboto | Slider | 300, 400 | Google Fonts |

Las cinco familias llegan desde `fonts.googleapis.com` mediante `@import`, que bloquea el renderizado; todas tienen licencia SIL OFL, es decir, son libres. La identidad tipográfica real son dos familias (Kumbh Sans y Heebo); las otras tres son residuo. Tamaños, interlineados y escala no quedaron registrados: [NO VERIFICADO].

### Archivos de logo disponibles

| Archivo | Dimensiones | Formato | Uso actual |
|---|---|---|---|
| `cropped-01_logo_partner-1.jpg` | 600×124 px (15 KB) | JPEG, sin transparencia, incluye sello «partner» | Cabecera, alt «Digital G+» |
| `Digital-G_blanco.png` | 350×150 px | PNG | Pie, alt «DigitalG+» |
| `cropped-Digital-G.png` | 350×150 px | PNG | Sin uso visible registrado |
| `cropped-favicon_Digital-G.png` | 512×512 px | PNG | Favicon |
| `11_logo_blanco_bibliotheca.png` | no registrada | PNG | Lámina 1 del slider y pie |

No existe versión vectorial de ningún logo. Todas las rutas cuelgan de `https://digitalgmas.cl/wp-content/uploads/2023/05/`.

## 3. Todo el contenido migrable cabe en un párrafo, tres láminas y 17 fichas

Las imágenes del sitio se descargaron completas: 91 archivos, 9,5 MB. La biblioteca de medios expone 71 elementos por la API REST (declara 137; el resto no es público). Salvo indicación, las rutas de imagen cuelgan de `https://digitalgmas.cl/wp-content/uploads/`.

### 3.1 Elementos comunes a todas las páginas

**Cabecera.** Logo `2023/05/cropped-01_logo_partner-1.jpg` (600×124, alt «Digital G+») enlazado a `https://digitalgmas.cl/`, y título del sitio como enlace de texto: «Digital GMAS». Antes, enlace «Skip to content» → `#content` [texto y destino tomados de la lectura preliminar].

**Menú (literal, del HTML).**

| Nivel 1 | Nivel 2 | Nivel 3 | Destino |
|---|---|---|---|
| Inicio | | | `https://digitalgmas.cl/` |
| ¿Quienes Somos? | | | `https://digitalgmas.cl/quienes-somos/` |
| Nuestros Servicios | | | `https://digitalgmas.cl/nuestros-servicios/` |
| | Digitalización | | `https://digitalgmas.cl/#servicio1` |
| | | Digitalización Bibliografías | `/servicio/digitalizacion-bibliografias/` |
| | | Digitalización de documentos | `/servicio/digitalizacion-de-documentos/` |
| | | Digitalización de Documentos Históricos y Patrimoniales | `/servicio/digitalizacion-material-patrimonial/` |
| | Productos Bibliotheca | | `https://digitalgmas.cl/#servicio2` |
| | | Antenas de seguridad (RFID) | `/servicio/antenas-de-seguridad-rfid/` |
| | | Auto préstamo | `/servicio/auto-prestamo/` |
| | | Estanterías inteligentes | `/servicio/estanterias-inteligentes/` |
| | | Cuenta personas y análisis de datos | `/servicio/cuenta-personas-y-analisis-de-datos/` |
| | | Auto préstamo desde el móvil (CloudLibrary) | `/servicio/auto-prestamo-desde-el-movil/` |
| | | Inventarios y gestión de colecciones | `/servicio/inventarios-y-gestion-de-colecciones/` |
| | Plataformas y productos con IA (Inteligencia Artificial) | | `https://digitalgmas.cl/#servicio3` |
| | | Portal de Bibliotecas | `/servicio/portal-de-bibliotecas/` |
| | | Koha: Instalación y soporte | `/servicio/koha-instalacion-y-soporte/` |
| | | Buscador de Bibliografías | `/servicio/buscador-bibliografias/` |
| | | Biblioteca Agéntica: Tu biblioteca responde las 24 horas. | `/servicio/agente-biblioteca/` |
| | | Visor de PDF | `/servicio/visor-libro-ia/` |
| Nuestros Clientes | | | `https://digitalgmas.cl/nuestros-clientes/` |
| Contacto | | | `https://digitalgmas.cl/contacto/` |

El menú enlaza 14 fichas. Lockers inteligentes no está.

**Pie (literal).** Imagen `2023/05/Digital-G_blanco.png` (350×150, alt «DigitalG+») · h4 «Digital G +» · «Contacto@digitalgmas.cl» → `mailto:contacto@digitalgmas.cl` · «+56 9 7389 1319» → `tel:+56973891319` · h6 «Somos distribuidor de Bibliotheca en Chile.» · imagen `2023/05/11_logo_blanco_bibliotheca.png` (alt «Bibliotheca») · párrafo «© DigitalG+, Todos los derechos reservados. | Un sitio: iP21», con «iP21» → `https://ip21.cl/`. Sobre el pie, flecha «volver arriba»: imagen `https://ip21.cl/wp-content/uploads/2020/08/flecha-1.png` (alt «Flecha iP21») con enlace `#page`.

**Metadatos comunes.** `<html lang="es-CL">`; contenedor `GTM-PCLFRV6` en el `<head>`.

### 3.2 Inicio — `https://digitalgmas.cl/`

Title: «DigitalG - Asistencia bibliotecaria de calidad.» Meta descripción: «DigitalG+ es una consultora con expertos bibliotecarios y documentalistas, ofreciendo servicios de gestión documental y bibliográfica». Sin `og:image`. Canonical `https://digitalgmas.cl/`. **Sin h1.**

**Slider (Smart Slider 3, tres láminas; textos literales).**

| Lámina | Título | Texto | Botón → destino | Imagen de lámina (alt) |
|---|---|---|---|---|
| 1 | «Partner Bibliotheca» | «Somos distribuidor de Bibliotheca en Chile» | «Ver más» → `#` | `2023/05/11_logo_blanco_bibliotheca.png` («logo_blanco_bibliotheca») |
| 2 | «Digitalización de Bibliografía» | «Grupo de profesionales interdisciplinarios en gestión documental y bibliográfica.» | «Ver más» → `https://digitalgmas.disenositioweb.cl/servicio/digitalizacion-bibliografias/` | `2023/05/13_bibliografia_digital.png` («bibliografia_digital») |
| 3 | «Desarrollo de portales y plataforma» | «Súmate al cambio y adopta las herramientas de transformación digital» | «Ver más» → `https://digitalgmas.disenositioweb.cl/servicio/koha-instalacion-y-soporte/` | `2023/05/08_icono1.png` («Icono servicios digitales») |

Fondos del slider: `2023/05/04_slider.jpg`, `2023/05/01_slider.jpg` y `2023/05/03_slider.jpg`, JPEG de 1920×400, los tres con alt vacío. Aparecen en ese orden en el HTML; su correspondencia con las láminas 1, 2 y 3 es [DEDUCIDO] por orden de aparición. Las dimensiones de las tres imágenes de lámina no quedaron registradas.

**Sección «Nuestros Servicios» (h2).** Tres pestañas-ancla: «Digitalización» → `#servicio1`, «Productos Bibliotheca» → `#servicio2`, «Plataformas y productos con IA (Inteligencia Artificial)» → `#servicio3`. Imagen decorativa `2023/05/01_servicio.png` (580 KB; alt «Quienes Somos», erróneo). Luego tres h3 y 15 tarjetas de título + ícono, sin texto descriptivo:

| # | Grupo (h3) | Título literal (texto del enlace) | Destino | Ícono | Alt literal | Dimensiones |
|---|---|---|---|---|---|---|
| 1 | Digitalización | Digitalización Bibliografías | `/servicio/digitalizacion-bibliografias/` | `2023/05/01_digitalizacion.png` | «Digitalización Bibliografías» | 300×300 |
| 2 | Digitalización | Digitalización de documentos | `/servicio/digitalizacion-de-documentos/` | `2023/05/03_digitalizacion.png` | «Digitalización de documentos» | 300×300 |
| 3 | Digitalización | Digitalización de Documentos Históricos y Patrimoniales | `/servicio/digitalizacion-material-patrimonial/` | `2023/05/02_digitalizacion.png` | «Digitalización material patrimonial» | 300×300 |
| 4 | Productos Bibliotheca | Antenas de seguridad (RFID) | `/servicio/antenas-de-seguridad-rfid/` | `2023/05/01_antena.png` | «antena» | 300×300 |
| 5 | Productos Bibliotheca | Cuenta personas y análisis de datos | `/servicio/cuenta-personas-y-analisis-de-datos/` | `2023/05/02_analisis.png` | «Cuenta personas y análisis de datos» | 300×300 |
| 6 | Productos Bibliotheca | Auto préstamo | `/servicio/auto-prestamo/` | `2023/05/03_autoprestamo.png` | «autoprestamo» | 300×300 |
| 7 | Productos Bibliotheca | Auto préstamo desde el móvil (CloudLibrary) | `/servicio/auto-prestamo-desde-el-movil/` | `2023/05/04_auto_mobile.png` | «Auto préstamo desde el móvil» | 300×300 |
| 8 | Productos Bibliotheca | Estanterías inteligentes | `/servicio/estanterias-inteligentes/` | `2023/05/05_estanterias-1.png` | «estanterias» | 300×300 |
| 9 | Productos Bibliotheca | Inventarios y gestión de colecciones | `/servicio/inventarios-y-gestion-de-colecciones/` | `2023/05/06_inventarios.png` | «inventarios» | 300×300 |
| 10 | Productos Bibliotheca | Lockers inteligentes | `/servicio/lockers-inteligentes/` | `2023/05/07_lockers.png` | «Lockers inteligentes» | 300×300 |
| 11 | Plataformas y productos con IA (Inteligencia Artificial) | Portal de Bibliotecas | `/servicio/portal-de-bibliotecas/` | `2023/05/01_portal.png` | «Portal de Bibliotecas» | 300×300 |
| 12 | Plataformas y productos con IA (Inteligencia Artificial) | Biblioteca Agéntica: Tu biblioteca responde las 24 horas. | `/servicio/agente-biblioteca/` | `2026/10/agente.png` | vacío | 335×335 |
| 13 | Plataformas y productos con IA (Inteligencia Artificial) | Koha: Instalación y soporte | `/servicio/koha-instalacion-y-soporte/` | `2023/05/03_koha.png` | «Koha: Instalación y soporte» | 300×300 |
| 14 | Plataformas y productos con IA (Inteligencia Artificial) | Visor de PDF | `/servicio/visor-libro-ia/` | `2026/10/visor2.png` | vacío | 335×335 |
| 15 | Plataformas y productos con IA (Inteligencia Artificial) | Buscador de Bibliografías | `/servicio/buscador-bibliografias/` | `2026/10/buscador.png` | vacío | 335×335 |

**Sección «Ellos confían en nosotros» (h2).** 19 logos sin enlace ni texto (detalle en 3.7). La portada no contiene el párrafo de Quiénes somos ni ningún botón de contacto.

### 3.3 ¿Quienes Somos? — `https://digitalgmas.cl/quienes-somos/`

Title: «Digital GMAS DigitalG+, Asistencia bibliotecaria de calidad.» Meta descripción: «DigitalG+ es una consultora con expertos bibliotecarios y documentalistas, ofreciendo servicios de gestión documental y bibliográfica para mejorar la experiencia del usuario en unidades de información.» Sin `og:image`.

h1: «¿Quienes Somos?»

Único párrafo (literal):

> DigitalG+ es una Empresa de consultoría formada por un grupo de profesionales interdisciplinarios que incluyen principalmente Bibliotecarios Documentalistas especializados en brindar un servicio y asistencia técnica en diferentes áreas de unidades de información que realizan gestión documental y bibliografica. Nuestro Principal Objetivo es proporcionar servicios de calidad que contribuyan a mejorar la gestión y la experiencia de sus usuarios.

Imagen de cabecera según la lectura preliminar: `2023/05/01_portada_quienes_somos.jpg` (alt «Quienes Somos»); no figura en la extracción del HTML del contenido y sus dimensiones no se midieron por nombre [NO VERIFICADO; las notas registran «otros fondos» de 1920×600 sin listarlos]. Sin enlaces en el contenido.

### 3.4 Nuestros Servicios — `https://digitalgmas.cl/nuestros-servicios/`

Mismo title y misma meta descripción que Quiénes somos. Sin `og:image`. h1: «Nuestros Servicios». **Sin ningún párrafo.** Contiene los mismos tres h3 y las mismas 15 tarjetas de la portada, en el mismo orden, con las mismas imágenes, alts y destinos (tabla de 3.2).

### 3.5 Nuestros Clientes — `https://digitalgmas.cl/nuestros-clientes/`

Mismo title y misma meta descripción. Sin `og:image`. h1: «Nuestros Clientes». **Sin ningún párrafo.** 16 logos sin enlace (los n.º 1–16 de la tabla de 3.7).

### 3.6 Contacto — `https://digitalgmas.cl/contacto/`

Mismo title y misma meta descripción. Sin `og:image`. h1: «Contacto». Sin texto. Formulario Ninja Forms (id 3), con campos leídos del JSON incrustado:

| Campo | Tipo | Obligatorio |
|---|---|---|
| Nombre | texto | sí |
| Correo Electrónico | email | sí |
| Teléfono | — | no |
| Consulta | área de texto | sí |
| Enviar | botón | — |

Protección: honeypot y reCAPTCHA. El destinatario real del formulario, los mensajes de éxito y de error no son visibles desde fuera [NO VERIFICADO]. Los únicos datos de contacto del sitio son el correo y el teléfono del pie.

### 3.7 Los 19 logos de clientes

Todos son JPEG de 850×464 px sobre fondo blanco. **Ningún nombre de institución figura como texto en el sitio**: la columna «Institución» es [DEDUCIDO] a partir del alt y del nombre de archivo, y los 19 requieren confirmación del dueño antes de publicarse. La columna «Estado» distingue las deducciones razonables de las ambiguas.

| # | Archivo | Alt literal | Institución [DEDUCIDO] | Estado | Portada | Pág. Clientes |
|---|---|---|---|---|---|---|
| 1 | `2023/05/01_uc-1.jpg` | «UC» | Pontificia Universidad Católica de Chile | Probable — confirmar | sí | sí |
| 2 | `2023/05/02_sii-1.jpg` | «sii» | Servicio de Impuestos Internos | Probable — confirmar | sí | sí |
| 3 | `2023/05/03_uss-1.jpg` | «San Sebastian» | Universidad San Sebastián | Probable — confirmar | sí | sí |
| 4 | `2023/05/04_u_conce-1.jpg` | «u de conce» | Universidad de Concepción | Probable — confirmar | sí | sí |
| 5 | `2023/05/05_ubo-1.jpg` | «UBO» | ¿Universidad Bernardo O'Higgins? | **Ambiguo — confirmar** (una lectura automática lo expandió como Universidad del Bío-Bío) | sí | sí |
| 6 | `2023/05/06_uoh-2.jpg` | «UOH» | Universidad de O'Higgins | Probable — confirmar | sí | sí |
| 7 | `2023/05/07_uah-1.jpg` | «uah» | ¿Universidad Alberto Hurtado? | **Ambiguo — confirmar** | sí | sí |
| 8 | `2023/05/08_central.jpg` | «Universidad Central» | Universidad Central | Probable (alt explícito) — confirmar nombre completo | sí | sí |
| 9 | `2023/05/08_ucsc.jpg` | «ucsc» | Universidad Católica de la Santísima Concepción | Probable — confirmar | sí | sí |
| 10 | `2023/05/09_ua.jpg` | «UA» | ¿Universidad Autónoma, de Atacama, de Antofagasta? | **Ambiguo — confirmar** | sí | sí |
| 11 | `2023/05/10_enac-1.jpg` | «enac» | ENAC | Probable — confirmar nombre completo | sí | sí |
| 12 | `2023/05/11_san_agustin.jpg` | «san_agustin» | ¿Colegio o instituto San Agustín? | **Ambiguo — confirmar** | sí | sí |
| 13 | `2023/05/12_subercasaex.jpg` | «subercaseaux» | ¿Instituto Guillermo Subercaseaux? | **Ambiguo — confirmar** | sí | sí |
| 14 | `2023/05/13_porandes.jpg` | «Pro Andes» | Sin deducción fiable (el archivo dice «porandes», el alt «Pro Andes») | **Ambiguo — confirmar** | sí | sí |
| 15 | `2023/05/14_aiep.jpg` | «aiep» | AIEP | Probable — confirmar | sí | sí |
| 16 | `2023/05/15_medicina.jpg` | «Facultad medicina» | Facultad de Medicina de universidad no indicada | **Ambiguo — confirmar** | sí | sí |
| 17 | `2026/10/uandes.jpg` | vacío | Universidad de los Andes | Probable — confirmar | sí | no |
| 18 | `2026/10/iplacex.jpg` | vacío | IPLACEX | Probable — confirmar | sí | no |
| 19 | `2026/10/alba.jpg` | vacío | Sin deducción | **Ambiguo — confirmar** | sí | no |

Los archivos están descargados, pero las notas no registran que se hayan abierto para leer el nombre dentro de cada logo; hacerlo resolvería varias ambigüedades sin consultar al dueño.

### 3.8 Las 17 fichas de servicio

Todas comparten plantilla: title «[Nombre] - Digital GMAS», sin meta descripción, h1 con el nombre, h2 «Navegación de entradas» con enlaces «« Previous Post» y «Next Post »», y ningún formulario, video, PDF ni botón de contacto. Las imágenes marcadas con † son banners de cabecera de la plantilla (fuera del bloque de contenido). Verificado después en el HTML: las 15 fichas del menú más Lockers tienen un banner propio de 1900×300 px (JPEG), ya descargado; «Quiénes somos» tiene uno de 1920×300. Los archivos que no se listan en cada ficha son: `02_bg.jpg` (Auto préstamo móvil), `06_autoprestamo.jpg`, `05_01_cuenta.jpg`, `08_estanterias-1.jpg`, `09_inventario.jpg`, `01_bg_koha-1.jpg`, `11_portal_biblioteca.jpg`, `2026/10/ia.jpg` (Biblioteca Agéntica), `2026/10/buscador.jpg`, `2026/10/visor-1.jpg`. Las 3 URL de categoría redirigen (301) a las anclas de la portada (`/#servicio1`, etc.). Las migas de pan («Inicio / Servicios / [categoría] / [título]») provienen también de la lectura preliminar.

#### Grupo Digitalización

**F1. Digitalización Bibliografías** — `https://digitalgmas.cl/servicio/digitalizacion-bibliografias/`
`og:image`: `2023/05/02_digitalizacion.jpg`. Texto literal:

> La digitalización de bibliografías es un servicio especializado para bibliotecas que mejorará el acceso y la disponibilidad de los recursos bibliográficos, permitiendo a los usuarios acceder de manera más eficiente y cómoda en su proceso de estudio e investigación académica.
>
> Entre las acciones que contempla el servicio:
>
> - Desempate y empaste de libros.
> - Escaneo y captura de imágenes con OCR.
> - Procesamiento de las imágenes: Las imágenes digitalizadas son sometidas a un proceso de optimización y edición para asegurar una reproducción clara y legible en el caso que el material presente textos y/o contenido adicional.
> - Conversión de PDF a un formato seguro según requerimientos de la legislación actual Ley 17.336 Art. 71 K.
> - Creación de índices.
> - Indicadores de uso.

Imágenes: `digitalgmas.disenositioweb.cl/…/2023/05/02_digitalizacion-300x143.jpg` (alt «Digitalización Bibliografías»; original 900×430) y `digitalgmas.disenositioweb.cl/…/2023/05/03-1.jpg` (alt «Digitalización Bibliografías»; 900×430); † `2023/05/04_fondo.jpg`. Enlaces: Previous → `/servicio/buscador-bibliografias/`; Next → `/servicio/digitalizacion-material-patrimonial/`. Si la lista es numerada o de viñetas no se pudo fijar: la lectura preliminar dice numerada y la extracción no lo distingue.

**F2. Digitalización de documentos** — `https://digitalgmas.cl/servicio/digitalizacion-de-documentos/`
Sin `og:image`. Texto literal (un párrafo, con doble espacio tras «entre otros.»):

> Este servicio está orientado a instituciones y empresas que requieran digitalizar sus documentos para su conservación, optimización de espacios físicos, mejorar el acceso, entre otros.  Además, del escaneo de los documentos ofrecemos soluciones tecnológicas personalizadas y flexibles, diseñadas para optimizar la gestión documental.

Imágenes: ninguna en el contenido; † `2023/05/02_digitalizacion_documentos.jpg` (alt «Digitalización de documentos»). Enlaces: Previous → `/servicio/digitalizacion-material-patrimonial/`; Next → `/servicio/lockers-inteligentes/`.

**F3. Digitalización de Documentos Históricos y Patrimoniales** — `https://digitalgmas.cl/servicio/digitalizacion-material-patrimonial/`
Sin `og:image`. Texto literal:

> La digitalización de documentos históricos y patrimoniales tiene como objetivo de preservar, facilitar el acceso, difusión, y protección de posibles daños o pérdidas. Esta práctica se ha vuelto cada vez más importante en el ámbito de la preservación del patrimonio cultural y la gestión de archivos.
>
> Entre las acciones que contempla el servicio:
>
> - Evaluación de especialistas en el área de conversación y restauración.
> - Preparación física del material.
> - Escaneo y captura de imágenes con OCR.
> - Procesamiento de las imágenes: puede incluir ajustes de contraste, eliminación de manchas o raspaduras, corrección de inclinación, entre otros.

Imágenes: ninguna en el contenido; † `2023/05/03_digitalizacion_historica.jpg`. Enlaces: Previous → `/servicio/digitalizacion-bibliografias/`; Next → `/servicio/digitalizacion-de-documentos/`.

#### Grupo Productos Bibliotheca

**F4. Antenas de seguridad (RFID)** — `https://digitalgmas.cl/servicio/antenas-de-seguridad-rfid/`
Sin `og:image`. Texto literal:

> El lugar seguro no sólo debe priorizar la seguridad, sino también brindar un entorno agradable y estéticamente atractivo. Es de gran importancia lograr un equilibrio entre la protección de su inversión y la apariencia visual de su biblioteca. Es por eso que las puertas de seguridad están diseñadas específicamente para ofrecer características innovadoras que aseguran sus materiales sin comprometer el ambiente acogedor de su espacio.
>
> Contamos con puertas Tattle-Tape hasta las soluciones RFID, todas nuestras opciones de seguridad están diseñadas para adaptarse a diferentes necesidades y tecnologías RFID, de ultra alta frecuencia (UHF), electromagnética (EM).

h5 «Más información» → `https://www.bibliotheca.com/es-la/soluciones/deteccion-de-seguridad/`. Imágenes: ninguna en el contenido; † `2023/05/04_antena_seguridad.jpg` (alt «antena_seguridad»). Enlaces: Next → `/servicio/cuenta-personas-y-analisis-de-datos/` (es la primera entrada; no tiene Previous).

**F5. Cuenta personas y análisis de datos** — `https://digitalgmas.cl/servicio/cuenta-personas-y-analisis-de-datos/`
`og:image`: `2023/05/02_open_count.jpg`. Texto literal (un párrafo):

> Es sistema de conteo de personas open+ count utiliza cámaras inteligentes cuentan personas en forma anónima y precisa de quienes entran y salen de la biblioteca. open+ count, también proporciona datos estratégicos e informes de uso para ayudar a las bibliotecas a tomar decisiones basadas en datos sobre el uso futuro del espacio de la biblioteca. Además de gestionar la ocupación, se puede utilizar en múltiples áreas dentro de la biblioteca para analizar patrones de uso.

h5 «Más información» → `https://www.bibliotheca.com/es-la/soluciones/ocupacion-cumplimiento/`. Imágenes: `digitalgmas.disenositioweb.cl/…/2023/05/02_open_count.jpg` (alt «Cuenta personas y análisis de datos – Open+ count»; 900×284) y `digitalgmas.disenositioweb.cl/…/2023/05/05_02_cuenta-300x220.jpg` (alt «Cuenta personas y análisis de datos » con espacio final; original 900×660); † `2023/05/05_01_cuenta.jpg`. Enlaces: Previous → `/servicio/antenas-de-seguridad-rfid/`; Next → `/servicio/auto-prestamo/`.

**F6. Auto préstamo** — `https://digitalgmas.cl/servicio/auto-prestamo/`
`og:image`: `2023/05/06_01_autoprestamo.jpg`. Texto literal:

> Incorpora en tu biblioteca la mejor experiencia de préstamo y devolución para tus usuarios con interfaz intuitiva y sean muy sencillas de utilizar. Sin importar la tecnología que utilice tu biblioteca RFID, EM o de códigos de barras. Contamos con variados modelos y configuraciones disponibles desde características audibles, visuales, táctiles, textos, entre otros para crear la mejor experiencia de usuario para tu biblioteca.

h5 «Más información» → `https://www.bibliotheca.com/es-la/soluciones/prestamo-autoservicio/`. Imágenes: `digitalgmas.disenositioweb.cl/…/2023/05/06_01_autoprestamo-300x169.jpg` (alt «Auto préstamo»; original 900×506); † `2023/05/06_autoprestamo.jpg`. Enlaces: Previous → `/servicio/cuenta-personas-y-analisis-de-datos/`; Next → `/servicio/auto-prestamo-desde-el-movil/`.

**F7. Auto préstamo desde el móvil (CloudLibrary)** — `https://digitalgmas.cl/servicio/auto-prestamo-desde-el-movil/`
`og:image`: `2023/05/01_img.jpg`. Texto literal (doble espacio tras «cloudLibrary» en el tercer párrafo):

> Los préstamos desde la aplicación CloudLibrary les permitirá a sus usuarios gestionar sus préstamos directamente desde la palma de la mano. Mediante el escaneo del código de barras de un libro con la cámara de un dispositivo móvil y un simple toque en el botón de préstamo y luego deshabilitar la seguridad los usuarios podrán gestionar su préstamo brindando con esto una experiencia en el servicio.
>
> El préstamo desde CloudLibrary no sólo facilita el préstamo de una forma autónoma y sencilla, sino que también permite a las bibliotecas promocionar información importante a su comunidad académica mediante notificaciones. Esto permite una comunicación efectiva y oportuna con los usuarios, manteniéndolos informados sobre actividades y nuevos recursos y servicios que incorpora la Biblioteca.
>
> El préstamo desde cloudLibrary  es compatible con tecnología RFID, EM o de códigos de barras.

h5 «Más información» → `https://www.bibliotheca.com/es-la/soluciones/prestamo-movil/`. Imágenes: `digitalgmas.disenositioweb.cl/…/2023/05/01_img.jpg` (alt «autoprestamo»; 900×639); † `2023/05/02_bg.jpg` (alt «autoprestamo»). Enlaces: Previous → `/servicio/auto-prestamo/`; Next → `/servicio/estanterias-inteligentes/`.

**F8. Estanterías inteligentes** — `https://digitalgmas.cl/servicio/estanterias-inteligentes/`
`og:image`: `2023/05/08_01_estanterias.jpg`. Texto literal:

> Esta tecnología permite a los usuarios experimentar un proceso rápido en la devolución sus materiales, al mismo tiempo que tienen acceso a una colección que recién ha sido devuelta. Por otro lado, las devoluciones automatizadas reducen el tiempo que el personal bibliotecario dedica a ingresar y reorganizar material en los estantes, lo que les permite tener más tiempo para interacciones significativas con los usuarios.
>
> Una de las principales características de esta tecnología es que cuenta con un tamaño reducido y su instalación sencilla, lo que lo convierte en la opción ideal para bibliotecas que desean implementar un sistema de devolución automática sin incurrir en altos costos de inversión y sin requerir un espacio significativo como una solución completa de manipulación automatizada de materiales.

h5 «Más información» → `https://www.bibliotheca.com/es-la/soluciones/estantes-inteligentes-de-devolucion/`. Imágenes: `digitalgmas.disenositioweb.cl/…/2023/05/08_01_estanterias-300x165.jpg` (alt «Estanterías inteligentes»; original 900×495); † `2023/05/08_estanterias-1.jpg`. Enlaces: Previous → `/servicio/auto-prestamo-desde-el-movil/`; Next → `/servicio/inventarios-y-gestion-de-colecciones/`.

**F9. Inventarios y gestión de colecciones** — `https://digitalgmas.cl/servicio/inventarios-y-gestion-de-colecciones/`
`og:image`: `2023/05/09_01_inventario.jpg`. Texto literal:

> Ofrecemos una amplia gama de herramientas tecnológicas diseñadas para realizar inventarios de manera rápida y gestionar grandes colecciones sin problemas. Los datos se capturar desde un dispositivo RFID inalámbrico integrado con tecnología Android. Este dispositivo es resistente, eficiente y cuenta con un potente alcance. Permite leer etiquetas RFID que se encuentren cerca de superficies metálicas.
>
> Con esta herramienta, puede encontrar rápidamente libros faltantes, identificar y reposicionar materiales mal colocados, localizar reservas, realizar inventarios y restablecer la seguridad, todo en una sola pasada. Las alertas visuales y auditivas le notifican cuando se encuentra un elemento, mostrando su nombre. Cuenta con una alta duración de su batería permite estar en acción durante todo el tiempo que sea necesario, mientras que su velocidad de escaneo de 20 artículos por segundo garantiza una eficiencia máxima.
>
> Además, de la generación de informes y análisis sobre múltiples ubicaciones desde una única plataforma central.

h5 «Más información» → `https://www.bibliotheca.com/library-technology-meet-the-new-dla-inventorywand/` (página en inglés). Imágenes: `digitalgmas.disenositioweb.cl/…/2023/05/09_01_inventario-300x167.jpg` (alt «Inventarios y gestión de colecciones»; original 900×500); † `2023/05/09_inventario.jpg`. Enlaces: Previous → `/servicio/estanterias-inteligentes/`; Next → `/servicio/portal-de-bibliotecas/`.

**F10. Lockers inteligentes** — `https://digitalgmas.cl/servicio/lockers-inteligentes/` (fuera del menú)
Sin `og:image`. Texto literal:

> Diseñado para ampliar la cobertura y accesibilidad de la biblioteca, remoteLocker ofrece un cómodo autoservicio para recoger reservas, consultar el catálogo y hacer devoluciones. El sistema modular se puede personalizar para cualquier biblioteca o espacio, incluso en exteriores. La pantalla de remoteLocker funciona como tablero, para difundir mensajes a todos sus usuarios. Más información en:

h5 «Lockers de Retiro» → `https://www.bibliotheca.com/es-la/soluciones/lockers-de-retiro/`. Imágenes (slider Smart Slider 3): `slider2/01.jpeg`, `slider2/02.jpeg`, `slider2/03.jpeg`, las tres de 800×800 y con alt vacío; † `2023/05/10_lockers.jpg` (alt «Lockers inteligentes»). Enlaces: Previous → `/servicio/digitalizacion-de-documentos/`; Next → `/servicio/biblioteca-agentica/`.

#### Grupo Plataformas y productos con IA (Inteligencia Artificial)

**F11. Portal de Bibliotecas** — `https://digitalgmas.cl/servicio/portal-de-bibliotecas/`
Sin `og:image`. Texto literal:

> Ofrecemos un servicio integral de diseño, nos encargamos de cada etapa del proceso, desde el diseño atractivo y funcional de tu sitio web hasta la implementación de las últimas tecnologías, integraciones, y prácticas recomendadas. Estamos comprometidos en brindarte el apoyo necesario para potenciar tu institución y alcanzar el éxito en el entorno digital. Contamos con un equipo multidisciplinario para abordar tu proyecto.

Imágenes (slider): `slider3/03_ubo.jpeg`, `slider3/01_uoh.jpeg`, `slider3/02_enac.jpeg`, capturas de 600×315 con alt vacío y sin enlace a los portales que muestran; † `2023/05/11_portal_biblioteca.jpg`. Enlaces: Previous → `/servicio/inventarios-y-gestion-de-colecciones/`; Next → `/servicio/agente-biblioteca/`.

**F12. Biblioteca Agéntica: Tu biblioteca responde las 24 horas.** — `https://digitalgmas.cl/servicio/agente-biblioteca/` (versión del menú)
`og:image`: `2023/05/biblioteca_agentica_sistema.png`. Texto literal:

> Un agente de inteligencia artificial que atiende a tus estudiantes en cualquier momento, conectado en tiempo real a tu software de gestión y a tu portal institucional. Consulta la disponibilidad por sede, las bibliografías y los recursos digitales antes de responder, sin inventar datos. Además, orienta al estudiante sin hacerle las tareas.

Imágenes: `2023/05/biblioteca_agentica_sistema.png` (diagrama PNG de 1600×1000, alt vacío); † `2026/10/ia.jpg`. Enlaces: Previous → `/servicio/portal-de-bibliotecas/`; Next → `/servicio/koha-instalacion-y-soporte/`.

**F13. Biblioteca Agéntica** — `https://digitalgmas.cl/servicio/biblioteca-agentica/` (**duplicado**, fuera del menú y de las tarjetas)
Title: «Biblioteca Agéntica - Digital GMAS». Sin `og:image`. Texto literal (dos párrafos en la extracción del código fuente):

> Tu biblioteca responde las 24 horas.
>
> Un agente de inteligencia artificial que atiende a tus estudiantes en cualquier momento, conectado en tiempo real a tu software de gestión y a tu portal institucional. Consulta la disponibilidad por sede, las bibliografías y los recursos digitales antes de responder, sin inventar datos. Además, orienta al estudiante sin hacerle las tareas.

Diferencia con F12: el lema va como bajada y no en el h1, y no incluye el diagrama. Imágenes: ninguna en el contenido; † `2026/10/ia.jpg` (alt «ia»). Enlaces: Previous → `/servicio/lockers-inteligentes/`; Next → `/servicio/buscador-de-bibliografias/`.

**F14. Koha: Instalación y soporte** — `https://digitalgmas.cl/servicio/koha-instalacion-y-soporte/`
`og:image`: `2023/05/enac.jpg`. Texto literal:

> Koha es un sistema integrado de gestión de bibliotecas (SIGB) es conocido por ser el primer software libre y de código abierto en el ámbito de la automatización bibliotecaria. 100 % web, cuenta con los principales módulos para desarrollar la gestión de una biblioteca o unidad de información.
>
> Una de las características más destacadas de Koha es su enfoque colaborativo. El proyecto está respaldado por una comunidad global de desarrolladores y usuarios que colaboran para mejorar y mantener el software. Esto significa que las bibliotecas que utilizan Koha pueden beneficiarse de las contribuciones de la comunidad, así como adaptar y personalizar el sistema según sus necesidades específicas.
>
> Koha ha sido adoptado por bibliotecas y organizaciones en todo el mundo debido a su naturaleza de software libre y código abierto, lo que brinda flexibilidad, control y la capacidad de personalizar el sistema según las necesidades locales. Además, el hecho de que sea por código abierto permite que se realicen auditorías de seguridad y se detecten y solucionen posibles problemas de manera más transparente.

h5 «Más información» → `https://koha-community.org/`. Imágenes: `digitalgmas.disenositioweb.cl/…/2023/05/enac.jpg` (alt «Biblioteca Enac»; 900×492) y `digitalgmas.disenositioweb.cl/…/2023/05/02_koha.jpg` (alt «Koha»; 900×492); † `2023/05/01_bg_koha-1.jpg` (alt «koha»). Enlaces: Previous → `/servicio/agente-biblioteca/`; Next → `/servicio/visor-libro-ia/`.

**F15. Visor de PDF** — `https://digitalgmas.cl/servicio/visor-libro-ia/`
`og:image`: `2023/05/visor_libro_ia_sistema.png`. Texto literal (doble espacio tras «mucho más.»):

> El estudiante no sale del libro para estudiarlo.
>
> Convierte cada libro digital de tu colección en una herramienta activa de estudio. La lectura es en línea, página a página. El estudiante puede tomar notas, resaltar, poner marcadores, generar la cita bibliográfica de cada página y mucho más.  La descarga y la impresión de fragmentos se habilitan solo en los límites que fija la licencia de cada título.

Imágenes: `2023/05/visor_libro_ia_sistema.png` (diagrama PNG de 1600×1000, alt vacío); † `2026/10/visor-1.jpg` (alt «visor»). Enlaces: Previous → `/servicio/koha-instalacion-y-soporte/`; Next → `/servicio/buscador-bibliografias/`.

**F16. Buscador de Bibliografías** — `https://digitalgmas.cl/servicio/buscador-bibliografias/` (versión del menú)
`og:image`: `2023/05/buscador_bibliografias_sistema.png`. Texto literal:

> La bibliografía de cada asignatura, dentro del sistema de gestión de aprendizaje (LMS).
>
> Con su cuenta institucional, cada estudiante ve la bibliografía básica y complementaria de sus asignaturas, con citas APA listas y acceso al recurso digital o al ejemplar físico. Se integra a Canvas, Moodle o Blackboard (LTI 1.3) e incluye indicadores de uso para procesos de acreditación.

Imágenes: `2023/05/buscador_bibliografias_sistema.png` (diagrama PNG de 1600×1000, alt vacío); † `2026/10/buscador.jpg`. Enlaces: Previous → `/servicio/visor-libro-ia/`; Next → `/servicio/digitalizacion-bibliografias/`.

**F17. Buscador de Bibliografías** — `https://digitalgmas.cl/servicio/buscador-de-bibliografias/` (**duplicado**, fuera del menú y de las tarjetas)
Sin `og:image`. Texto literal:

> La bibliografía de cada asignatura, dentro del LMS.
>
> Con su cuenta institucional, cada estudiante ve la bibliografía básica y complementaria de sus asignaturas, con citas APA listas y acceso al recurso digital o al ejemplar físico. Se integra a Canvas, Moodle o Blackboard (LTI 1.3) e incluye indicadores de uso para procesos de acreditación.

Diferencia con F16: la bajada dice «dentro del LMS.» y no incluye el diagrama. Imágenes: ninguna en el contenido; † `2026/10/buscador.jpg` (alt «buscador»). Enlaces: Previous → `/servicio/biblioteca-agentica/` (es la última entrada; no tiene Next).

Según la lectura preliminar, las bajadas de F13, F15, F16 y F17 van en cursiva o negrita cursiva; el formato tipográfico exacto no se extrajo del HTML [NO VERIFICADO].

### 3.9 Páginas residuales de WordPress (no son contenido a migrar)

**Archivo de servicios** — `https://digitalgmas.cl/servicio/`. Title «Servicios archivo - Digital GMAS»; h1 «Archivos: Servicios»; párrafo «Servicios de Digital Gmas»; 10 extractos automáticos de fichas con «Continue Reading» y enlace «Older Posts» → `/servicio/page/2/`. Sus extractos repiten el texto de las fichas.

**Página de ejemplo** — `https://digitalgmas.cl/pagina-de-ejemplo/`. h1 «Página de ejemplo»; cinco párrafos del texto de muestra de WordPress (empieza «Esta es una página de ejemplo.» y termina «¡Que te diviertas!») con enlace «tu Dashboard» → `https://digitalgmas.disenositioweb.cl/wp-admin/`. No es texto del dueño.

**Slider Escritorio** — `https://digitalgmas.cl/super-simple-slider/slider-escritorio/`. Title «Slider Escritorio - Digital GMAS»; h1 «Slider Escritorio»; vacía.

**Medios sin uso visible.** `01_comics`, `02_catalogo`, `02_libros`, `05_insumos`, `img_insumos`, `04_img`, `01_digital` y varios fondos. Parecen de servicios antiguos [DEDUCIDO]; no deben incluirse sin confirmación.

### 3.10 Erratas del texto original, señaladas aparte

La transcripción anterior no corrige nada. La columna «Origen» indica si la errata la registraron las notas de investigación o si es una observación de esta síntesis (estas últimas son sugerencias a validar, no certezas).

| Dónde | Texto literal | Observación | Origen |
|---|---|---|---|
| Menú y h1 | «¿Quienes Somos?» | Falta tilde: «Quiénes» | Notas |
| Quiénes somos | «bibliografica» | Falta tilde | Notas |
| Quiénes somos | «Empresa», «Bibliotecarios Documentalistas», «Nuestro Principal Objetivo» | Mayúsculas no normativas | Notas |
| Pie | «Contacto@digitalgmas.cl» | Mayúscula inicial en el correo | Notas |
| Pie | «Digital G +» | Espacio antes del «+»; la grafía oficial es «Digital G+» | Notas |
| Slider, lámina 3 | «Desarrollo de portales y plataforma» | Singular/plural inconsistente | Síntesis |
| F1 (título) | «Digitalización Bibliografías» | Falta la preposición «de» | Síntesis |
| F1 | «Desempate y empaste de libros.» | Posible errata por «Desempaste»; confirmar con el dueño | Síntesis |
| F2 | «Además, del escaneo de los documentos ofrecemos» | Coma mal ubicada; doble espacio previo | Notas (doble espacio) / síntesis |
| F3 | «tiene como objetivo de preservar» | Sobra «de» | Notas |
| F3 | «conversación y restauración» | Probablemente «conservación» | Notas |
| F4 | «Contamos con puertas Tattle-Tape hasta las soluciones RFID» | Falta «desde»; enumeración final sin conjunción | Síntesis |
| F5 | «Es sistema de conteo» | «El sistema» | Notas |
| F5 | «utiliza cámaras inteligentes cuentan personas» | Oración mal construida | Notas |
| F6 | «con interfaz intuitiva y sean muy sencillas de utilizar» | Concordancia; la oración siguiente es un fragmento | Notas |
| F7 | «Los préstamos […] les permitirá» | Concordancia de número | Síntesis |
| F7 | «CloudLibrary» / «cloudLibrary» | Dos grafías del producto; doble espacio | Notas |
| F8 | «en la devolución sus materiales» | Falta «de» | Notas |
| F8 | «cuenta con un tamaño reducido y su instalación sencilla» | Construcción incompleta | Síntesis |
| F9 | «Los datos se capturar» | «capturan» | Notas |
| F9 | «Cuenta con una alta duración de su batería permite estar» | Oración mal construida | Notas |
| F9 | «Además, de la generación de informes […] central.» | Oración incompleta | Notas |
| F11 | «servicio integral de diseño, nos encargamos» | Coma por punto | Síntesis |
| F14 | «(SIGB) es conocido por ser» | Falta nexo | Síntesis |
| F14 | «sea por código abierto» | Sobra «por» | Síntesis |
| F15 | «mucho más.  La descarga» | Doble espacio | Notas |
| Archivo | «Servicios de Digital Gmas» | Sexta grafía de la marca | Síntesis |
| F5, alt | «open+ count» / «Open+ count» | Dos grafías del producto | Notas |

## 4. Las 28 URLs del sitemap: 25 responden 200 y 3 redirigen

El inventario proviene del `sitemap_index.xml` de Yoast (subsitemaps page, servicio, category y super-simple-slider) y el estado se comprobó con curl el 16-11-2026 ([sitemap](https://digitalgmas.cl/sitemap_index.xml)). Las notas dan el total de 28 y, por separado, comprueban también `/servicio/page/2/`; la cuenta cuadra en 28 si esa URL de paginación no forma parte del sitemap, lo cual es [DEDUCIDO] y por eso figura al final sin número.

| # | URL | Tipo | HTTP | Observación |
|---|---|---|---|---|
| 1 | `https://digitalgmas.cl/` | Página | 200 | Portada |
| 2 | `https://digitalgmas.cl/quienes-somos/` | Página | 200 | |
| 3 | `https://digitalgmas.cl/nuestros-servicios/` | Página | 200 | |
| 4 | `https://digitalgmas.cl/nuestros-clientes/` | Página | 200 | |
| 5 | `https://digitalgmas.cl/contacto/` | Página | 200 | |
| 6 | `https://digitalgmas.cl/pagina-de-ejemplo/` | Página | 200 | Muestra de WordPress, indexable |
| 7 | `https://digitalgmas.cl/servicio/` | Archivo | 200 | «Archivos: Servicios» |
| 8 | `https://digitalgmas.cl/servicio/digitalizacion-bibliografias/` | Ficha | 200 | |
| 9 | `https://digitalgmas.cl/servicio/digitalizacion-de-documentos/` | Ficha | 200 | |
| 10 | `https://digitalgmas.cl/servicio/digitalizacion-material-patrimonial/` | Ficha | 200 | Contenido correcto con barra final |
| 11 | `https://digitalgmas.cl/servicio/antenas-de-seguridad-rfid/` | Ficha | 200 | |
| 12 | `https://digitalgmas.cl/servicio/auto-prestamo/` | Ficha | 200 | |
| 13 | `https://digitalgmas.cl/servicio/auto-prestamo-desde-el-movil/` | Ficha | 200 | |
| 14 | `https://digitalgmas.cl/servicio/estanterias-inteligentes/` | Ficha | 200 | |
| 15 | `https://digitalgmas.cl/servicio/cuenta-personas-y-analisis-de-datos/` | Ficha | 200 | |
| 16 | `https://digitalgmas.cl/servicio/inventarios-y-gestion-de-colecciones/` | Ficha | 200 | |
| 17 | `https://digitalgmas.cl/servicio/lockers-inteligentes/` | Ficha | 200 | Fuera del menú |
| 18 | `https://digitalgmas.cl/servicio/portal-de-bibliotecas/` | Ficha | 200 | |
| 19 | `https://digitalgmas.cl/servicio/koha-instalacion-y-soporte/` | Ficha | 200 | |
| 20 | `https://digitalgmas.cl/servicio/buscador-bibliografias/` | Ficha | 200 | Versión del menú |
| 21 | `https://digitalgmas.cl/servicio/agente-biblioteca/` | Ficha | 200 | Versión del menú |
| 22 | `https://digitalgmas.cl/servicio/visor-libro-ia/` | Ficha | 200 | |
| 23 | `https://digitalgmas.cl/servicio/biblioteca-agentica/` | Ficha | 200 | Duplicado de la 21 |
| 24 | `https://digitalgmas.cl/servicio/buscador-de-bibliografias/` | Ficha | 200 | Duplicado de la 20 |
| 25 | `https://digitalgmas.cl/category/digitalizacion/` | Categoría | 301 | |
| 26 | `https://digitalgmas.cl/category/productos-bibliotheca/` | Categoría | 301 | |
| 27 | `https://digitalgmas.cl/category/plataformas-y-productos-con-ia-inteligencia-artificial/` | Categoría | 301 | |
| 28 | `https://digitalgmas.cl/super-simple-slider/slider-escritorio/` | Técnica (plugin) | 200 | Vacía, indexable |
| — | `https://digitalgmas.cl/servicio/page/2/` | Paginación del archivo | 200 | Comprobada aparte |

El destino exacto de los tres 301 no quedó anotado en la comprobación con curl; la lectura preliminar vio en esas tres URLs el contenido de la portada con canonical `https://digitalgmas.cl/`, lo que es coherente con una redirección a la portada. De las 28, solo 20 son contenido propio: 5 páginas y 15 servicios reales; las otras 8 son duplicados, residuos de WordPress o redirecciones.

## 5. Lo que el sitio no tiene y quedará como [PENDIENTE]

Ninguno de los elementos siguientes existe en el sitio actual. No se redactan aquí: completarlos exige texto o datos del dueño, y lo que no se entregue se omite o queda marcado.

| Vacío | Estado en el sitio actual | Marca |
|---|---|---|
| Misión, visión y valores | No existen; Quiénes somos es un solo párrafo | [PENDIENTE] |
| Historia, equipo y personas | No existen | [PENDIENTE] |
| Texto introductorio de Nuestros Servicios | No existe (solo h1 y tarjetas) | [PENDIENTE] |
| Descripción breve de cada tarjeta de servicio | No existe (solo título e ícono) | [PENDIENTE] |
| Texto de Nuestros Clientes | No existe (solo logos) | [PENDIENTE] |
| Nombres oficiales de los 19 clientes | No figuran como texto; solo siglas en alt | [PENDIENTE] |
| Casos de éxito, testimonios o cifras propias | No existen | [PENDIENTE] |
| Dirección física, horario de atención y mapa | No existen | [PENDIENTE] |
| Redes sociales | Ningún enlace en todo el sitio | [PENDIENTE] |
| Enlace de WhatsApp | No existe; solo el teléfono +56 9 7389 1319 como `tel:` | [PENDIENTE] (el número ya está decidido) |
| Texto de la página Contacto | No existe (solo h1 y formulario) | [PENDIENTE] |
| Política de privacidad y aviso legal | No existen, pese a que el formulario recoge datos personales | [PENDIENTE] |
| Descripción del servicio propio de Koha (instalación y soporte) | La ficha solo describe el software | [PENDIENTE] |
| Demostraciones o enlaces a los portales y plataformas propias | No existen en Portal, Buscador, Biblioteca Agéntica ni Visor | [PENDIENTE] |
| Folletos, fichas técnicas o descargas | No existen | [PENDIENTE] |
| Meta descripción por página y por ficha | 4 páginas comparten una; 17 fichas no tienen | [PENDIENTE] |
| Texto alternativo correcto de todas las imágenes | 18 vacíos y muchos inútiles | [PENDIENTE] |
| Imagen para compartir (`og:image`) de portada y páginas | No existe | [PENDIENTE] |
| Logo vectorial o en alta resolución | No existe en el sitio (máximo 600×124 JPEG) | [PENDIENTE] |
| Año en el copyright | No figura | [PENDIENTE] |

## 6. Los referentes del rubro convencen con evidencia; Apple y Xiaomi, con economía

Se revisaron cuatro sitios del sector, más algunos complementarios, analizando su HTML descargado; no hubo renderizado visual ni prueba en móvil, de modo que color, espaciado, animación y rendimiento de todos ellos quedan [NO VERIFICADO]. Lo que sigue son patrones observados que alimentan la Fase 2; este informe no los convierte en arquitectura ni en diseño.

### Bibliotheca, el fabricante: promesa con cifra y catálogo por familias

La portada para Latinoamérica concentra en su h1 una promesa y una prueba numérica de adopción, y ofrece un único botón hacia el ecosistema de soluciones ([Bibliotheca es-LA](https://www.bibliotheca.com/es-la/)). Su página de soluciones permite entrar por problema: nueve tarjetas redactadas como necesidad del bibliotecario conducen a la familia correspondiente, y cada bloque de familia repite una estructura fija de imagen, titular, resultados típicos, tecnologías asociadas y una acción ([Bibliotheca Solutions](https://www.bibliotheca.com/solutions/)). El menú reparte unas 22 entradas de producto en siete familias, y un mismo producto puede figurar en dos ([menú es-LA](https://www.bibliotheca.com/es-la/contacto-ubicaciones/)). La ficha de selfCheck 3000 sigue siempre el mismo orden: categoría, frase de beneficio, botón a contacto, tres características, folleto descargable y cierre con invitación ([selfCheck 3000](https://www.bibliotheca.com/es-la/selfcheck-3000/)). Como prueba social prefiere fotos de equipos en bibliotecas reales con pie que nombra a la institución, casos enlazados y testimonios con nombre y cargo, sin muro de logos ([Bibliotheca Solutions](https://www.bibliotheca.com/solutions/)). Sus debilidades también enseñan: los contadores de la portada valen 0 en el HTML sin JavaScript, quedan cadenas sin traducir en la versión en español, y el formulario vive en otro subdominio ([Bibliotheca es-LA](https://www.bibliotheca.com/es-la/)). Un dato útil para el posicionamiento: en su listado de oficinas de las Américas solo aparecen Brasil, Canadá y Estados Unidos ([contacto es-LA](https://www.bibliotheca.com/es-la/contacto-ubicaciones/)).

### Cayman Systems, el distribuidor regional: lo que conviene no repetir

El distribuidor ecuatoriano abre con un carrusel y un h1 hecho de palabras clave en lugar de una propuesta de valor, y su oferta para bibliotecas son dos tarjetas entre 24 mezcladas con retail, petróleo y hospitales ([Cayman Systems](https://caymansystems.com/)). Su página de Bibliotheca conserva visibles marcas de borrador como «(H2)» y «(CTA)», aunque acierta en dos cosas: nombra las integraciones SIP2/NCIP con sistemas como Koha y Symphony, y propone una demostración hecha con ejemplares de la colección del propio cliente ([Cayman Bibliotheca + 3M](https://caymansystems.com/biblotheca-3m.html)). El complemento mexicano refuerza la advertencia: Infoestratégica tiene publicado un bloque de testimonios con «Lorem ipsum» y obliga a saltar a otro dominio para ver los productos de biblioteca ([Infoestratégica](https://infoestrategica.com/), [Libtecs](https://libtecs.com/)).

### Baratz, software en español: tres familias repetidas con disciplina

La empresa española ordena todo su catálogo en tres familias y repite esa misma estructura en la portada, la página de familias y el contacto ([Baratz](https://www.baratz.es/), [Baratz Familias](https://www.baratz.es/familias-soluciones-baratz/)). Sus casos de éxito nombran a la institución y se titulan con una fórmula de resultado («cómo un producto ayudó a tal institución a lograr tal cosa»), y su sección de clientes combina una cifra con citas textuales ([Baratz](https://www.baratz.es/)). El formulario pide, además de los datos básicos, institución, cargo y qué solución usa ya el interesado, con casilla de privacidad ([Baratz Contacto](https://www.baratz.es/contacto/)). Flaquea donde Digital G+ ya decidió no flaquear: su hero no ofrece ninguna acción comercial. ByWater Solutions, complemento del mundo Koha, comete el error contrario de prioridad, pues antepone webinars y eventos a su oferta y carece de h1 ([ByWater Solutions](https://bywatersolutions.com/)).

### Internet Archive Digitization Services: un sitio pequeño que se entiende en cinco segundos

Es el referente más cercano en escala: menú de cinco ítems más un botón de inicio en la barra de navegación, h1 de dos palabras y una franja de siete logos de instituciones justo bajo el hero, cada uno enlazado a la colección que se le digitalizó ([IA Digitization](https://digitization.archive.org/)). Añade una cifra propia de volumen, tres tarjetas de servicio y un cierre que invita a contar el proyecto; su tropiezo es enviar esa acción principal a un Google Forms externo ([IA Digitization](https://digitization.archive.org/)). DT Heritage, complemento del mismo rubro, muestra el exceso opuesto: páginas con varios h1, textos muy largos y un menú de más de 30 productos ([DT Heritage](https://heritage-digitaltransitions.com/service-bureau/digitization-services-archives/)).

### Patrones a adoptar y a evitar

| Patrón observado | Dónde | Viabilidad con el material actual de Digital G+ |
|---|---|---|
| **Adoptar:** h1 que diga qué se hace y para quién, con una sola acción principal | Bibliotheca, Internet Archive | Viable. La cifra de prueba que lo acompaña en los referentes no existe: [PENDIENTE] |
| **Adoptar:** logos de clientes inmediatamente después del hero | Internet Archive | Viable con los 19 logos, previa confirmación de nombres. Enlazarlos a evidencia exige casos que no existen |
| **Adoptar:** entrada por necesidad además de por producto | Bibliotheca | Requiere redactar las necesidades; es contenido nuevo, no migrado |
| **Adoptar:** catálogo en pocas familias de dos niveles | Bibliotheca, Baratz | Viable: el sitio ya tiene 3 grupos y 15 servicios |
| **Adoptar:** plantilla constante de ficha con acción de contacto al inicio y al cierre | Bibliotheca | Viable; folleto descargable [PENDIENTE] |
| **Adoptar:** fotos de equipos en bibliotecas reales con pie que nombra la institución | Bibliotheca | Limitado: solo se dispone de las fotos actuales (máx. 900 px) y no hay pies con institución |
| **Adoptar:** casos titulados por resultado y citas con nombre y cargo | Baratz, Bibliotheca | No viable hoy: no hay casos ni testimonios. No inventar |
| **Adoptar:** formulario que pide institución, cargo e interés | Baratz | Viable; el actual tiene 4 campos |
| **Adoptar:** oferta concreta en la llamada a la acción | Cayman, Internet Archive | Coherente con «Solicitar cotización», ya decidido |
| **Adoptar:** mención explícita de integraciones y preguntas frecuentes | Cayman, Bibliotheca | Parcial: el sitio solo menciona Canvas, Moodle, Blackboard (LTI 1.3) y RFID/EM/códigos de barras. El resto es [PENDIENTE] |
| **Adoptar:** acción de contacto en la barra de navegación y como cierre de cada página | Internet Archive, Infoestratégica | Viable |
| **Evitar:** carrusel como apertura y h1 de palabras clave | Cayman | El sitio actual abre con carrusel y no tiene h1 |
| **Evitar:** grilla plana de decenas de productos | Cayman | — |
| **Evitar:** noticias o eventos antes que la oferta | ByWater | — |
| **Evitar:** texto de relleno, marcas de borrador, enlaces rotos, año vencido | Infoestratégica, Cayman, Libtecs | El sitio actual ya incurre en esto (página de ejemplo, enlaces a pruebas) |
| **Evitar:** cifras que dependen de JavaScript | Bibliotheca | — |
| **Evitar:** enviar a otro dominio o a un formulario externo | Infoestratégica, Internet Archive | Las fichas actuales derivan el «Más información» a bibliotheca.com |
| **Evitar:** hero sin acción comercial y párrafos largos de autodescripción | Baratz | — |

Tres advertencias sobre esta tabla. Primera: ninguno de los sitios revisados usa el rótulo «Solicitar cotización»; todos dicen «contáctenos», «hable con un experto» o «cuéntenos su proyecto». La decisión del dueño es diferenciadora y coherente con el objetivo, pero su eficacia relativa no está respaldada por estas fuentes. Segunda: no hay datos de conversión de ningún patrón; se recomienda por práctica observada, no por resultados medidos. Tercera: la portada de Bibliotheca para Latinoamérica destaca un caso de Duoc UC con cloudCheck mobile ([Bibliotheca es-LA](https://www.bibliotheca.com/es-la/)); Duoc UC no está entre los 19 logos de Digital G+ y las notas no acreditan participación de Digital G+ en ese proyecto, de modo que no puede usarse como prueba propia sin confirmación del dueño.

### Principios de apple.com y mi.com aplicables

La revisión se limitó a una página por sitio (la familia iPhone y la portada global de Xiaomi), sobre HTML estático. La portada de Xiaomi apila bloques de una sola idea: un producto, su imagen, un lema de tres a seis palabras y un único enlace ([mi.com](https://www.mi.com/global/)). Apple presenta cada modelo en tres escalones tipográficos —nombre, frase de valor de una línea, acciones— y repite el mismo par de acciones siempre en la misma posición ([apple.com/iphone](https://www.apple.com/iphone/)). Ambas aplican divulgación progresiva: la página de familia da lo mínimo y el detalle queda para la página de cada modelo, con la letra chica en notas al pie ([apple.com/iphone](https://www.apple.com/iphone/)). Apple además muestra la gama completa lado a lado antes de argumentar, y los dos documentos se sostienen en un único h1 y seis hojas de estilo, frente a las 25–40 de los sitios del rubro hechos con constructores ([apple.com/iphone](https://www.apple.com/iphone/), [mi.com](https://www.mi.com/global/)).

Cinco principios se trasladan a Digital G+: una idea por bloque; jerarquía de tres escalones; una acción constante y mínima, que aquí es «Solicitar cotización» en lugar de «Comprar»; detalle bajo demanda; y la imagen del producto como protagonista con alt descriptivo. El límite de la analogía es doble. El comprador institucional necesita evidencia (clientes, integraciones, soporte local) que Apple y Xiaomi no requieren, así que el minimalismo aplica a la forma y no a la prueba. Y la imagen protagonista choca con el material disponible: con fotos de 900 px e íconos de 300 px no hay con qué llenar una pantalla. Las animaciones al desplazarse y el uso del espacio en blanco, rasgos habituales de ambos sitios, no pudieron constatarse en el HTML: [NO VERIFICADO].

## 7. Once confirmaciones del dueño antes de la Fase 2

Ya están decididos y no se vuelven a preguntar: repositorio nuevo en GitHub, uso exclusivo del material gráfico del sitio actual, llamada principal «Solicitar cotización» con WhatsApp (+56 9 7389 1319) como secundaria, y «Digital G+» como nombre oficial. Queda por confirmar lo siguiente.

| # | Decisión o confirmación | Por qué bloquea la Fase 2 |
|---|---|---|
| 1 | **Fichas duplicadas:** ¿qué versión prevalece en Biblioteca Agéntica (lema en el título o como bajada) y en Buscador de Bibliografías («dentro del LMS» o «dentro del sistema de gestión de aprendizaje (LMS)»)? | Define si son 15 servicios y qué texto se migra |
| 2 | **Clientes:** nombre oficial de los 19 logos (8 son ambiguos), si los 19 siguen vigentes y autorizan su uso, y si los 3 de 2026 se suman a la página de clientes | Ningún nombre existe como texto en el sitio |
| 3 | **Clasificación:** ¿Lockers pasa a Productos Bibliotheca y al menú? ¿Koha, Portal de Bibliotecas y Visor de PDF siguen bajo «Plataformas y productos con IA»? ¿Se mantienen los tres nombres de grupo? | Es la base de la arquitectura |
| 4 | **Erratas:** ¿se autoriza corregir las erratas de 3.10 al migrar, o los textos pasan literales? Incluye confirmar «Desempate» y «conversación» | El encargo pide migración verbatim |
| 5 | **Vacíos:** de la lista de la sección 5, ¿qué entregará el dueño (misión/visión, dirección, redes, textos de Servicios y Clientes, descripción del servicio Koha) y qué se omite? | Sin esto no se sabe qué secciones existen |
| 6 | **Logo:** ¿se acepta el JPEG de 600×124 con sello «partner» como logo único, o el dueño tiene el archivo original del mismo logo? ¿El sello «partner» y la frase «Somos distribuidor de Bibliotheca en Chile» siguen vigentes y autorizados por Bibliotheca? | La regla de usar solo material actual deja el logo en baja resolución |
| 7 | **Lema:** ¿se conserva «Asistencia bibliotecaria de calidad» como bajada de marca? ¿Desaparece «Digital GMAS» de todo texto visible? | Hoy aparece en todos los títulos |
| 8 | **Slider:** ¿se migran los textos de las tres láminas tal cual, pese a la incoherencia de las láminas 2 y 3, y adónde debía apuntar la lámina 1? | Es parte del poco texto de marca existente |
| 9 | **Contacto:** ¿el formulario sigue llegando a contacto@digitalgmas.cl? ¿El +56 9 7389 1319 tiene WhatsApp activo? ¿Se pedirán institución, cargo y servicio de interés? | El destinatario actual no es visible desde fuera; el correo de destino consta solo como preferencia previa del dueño, no en el sitio |
| 10 | **Herencia de iP21:** ¿se elimina el crédito «Un sitio: iP21»? ¿Quién controla `digitalgmas.disenositioweb.cl` y la cuenta de Google Tag Manager `GTM-PCLFRV6`, y se mantiene esa medición? | Afecta dependencias y analítica |
| 11 | **Material sin uso:** ¿las imágenes de cómics, catálogo, libros e insumos corresponden a servicios vigentes que deban volver, o se descartan? ¿Se descartan también la página de ejemplo, el archivo `/servicio/` y la página del slider? | Evita perder u ofrecer servicios por error |

Una duodécima cuestión queda anotada para la propia Fase 2 y no requiere respuesta ahora: si se preservan los slugs actuales de las 15 fichas, varios de los cuales no coinciden con el nombre visible (`visor-libro-ia`, `agente-biblioteca`, `digitalizacion-material-patrimonial`).

## Conclusión

La auditoría invierte la expectativa habitual de un rediseño. Lo que suele faltar —identidad visual— aquí está completo y documentado en hex; lo que suele sobrar —contenido que podar— aquí casi no existe. El trabajo de las fases siguientes no consistirá en reorganizar mucho material sino en decidir cuánta página se construye con un párrafo institucional, 15 fichas breves, 15 íconos, diez fotos de producto de 900 px y 19 logos sin nombre. Esa escasez es compatible con la sobriedad de Apple y Xiaomi que el dueño busca, pero incompatible con el rasgo que hace convincentes a los mejores sitios del rubro: cifras, casos y testimonios con nombre de institución. Sin datos reales del dueño, esos bloques quedan como [PENDIENTE], no como relleno.

La ventaja competitiva más clara no está escrita en ninguna parte del sitio: Digital G+ es una consultora de bibliotecarios que además distribuye Bibliotheca en un país donde el fabricante no lista oficina propia, mientras que el distribuidor regional comparable diluye sus bibliotecas entre rubros ajenos. Convertir eso en texto es decisión y tarea del dueño. Las respuestas a las once confirmaciones, sobre todo los nombres de clientes, las fichas duplicadas y los vacíos que se llenarán, determinan el tamaño real del sitio nuevo; las mediciones pendientes de rendimiento, contraste y móvil pueden esperar a que exista el sitio estático, porque medir el WordPress que se abandona ya no cambia ninguna decisión.
