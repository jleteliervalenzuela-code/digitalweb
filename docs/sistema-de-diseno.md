# Sistema de diseño (Fase 3)

Todo vive en `src/assets/css/estilos.css`. Los valores de esta página están en la sección 2 «Tokens» de ese archivo: cambiarlos ahí cambia todo el sitio.

## Principios (inspirados en apple.com y mi.com, sin copiarlos)

- **Una idea por pantalla.** Cada sección de la portada tiene un solo mensaje y un solo llamado a la acción.
- **Jerarquía tipográfica fuerte y mucho aire.** Títulos grandes y compactos, bajadas en gris, respiro generoso entre secciones (72 a 144 px según el ancho).
- **Información revelada de a poco.** Las tres líneas de servicio van en pestañas en la portada; el detalle de cada servicio vive en su ficha.
- **Imagen de producto grande, a su tamaño real.** Las fotos del sitio anterior miden como máximo 900 px de ancho, así que nunca se muestran más grandes que eso (no se pixelan).
- **Movimiento sutil.** Entrada suave del hero al cargar y aparición de bloques al hacer scroll (opacidad y desplazamiento de 24 px). Se desactiva por completo si el visitante pide «reducir movimiento» y el contenido nunca queda oculto sin JavaScript.

## Colores

Paleta exacta del sitio anterior (extraída de `wp-bootstrap-4-child/style.css`). Contraste medido contra el fondo en que se usa; el mínimo WCAG AA es 4,5:1 para texto normal y 3:1 para texto grande e íconos.

| Token | Hex | Uso | Contraste |
|---|---|---|---|
| `--c-marino` | `#020d7e` | Títulos, botón principal, enlaces, pie | 14,9:1 sobre el fondo |
| `--c-azul` | `#2b36a7` | Hover del botón, antetítulos, inicio del degradado | 9,3:1 sobre el fondo |
| `--c-indigo` | `#2f2f6f` | Reservado para fondos oscuros | — |
| `--c-celeste` | `#0096ca` | Anillo de foco, flechas, borde de campos activos | 3,4:1 (solo elementos no textuales) |
| `--c-celeste-2` | `#1793c7` | Reservado (hover de enlaces del pie en el sitio anterior) | — |
| `--c-turquesa` | `#0fb9c3` | Antetítulos sobre fondo oscuro, fin del degradado | 6,6:1 sobre `#090979` |
| `--c-gris` | `#8696a2` | Separadores de las migas de pan (decorativo) | 3,0:1, no se usa en texto |
| `--c-fondo` | `#fafbff` | Fondo de página | — |
| `--c-blanco` | `#ffffff` | Tarjetas, secciones alternas | — |

**Neutros agregados.** El sitio anterior no definía un color de texto propio (usaba el de Bootstrap). Se derivaron de la sombra del tema, `rgba(27,31,56)`:

| Token | Hex | Uso | Contraste |
|---|---|---|---|
| `--c-tinta` | `#1b1f38` | Texto de párrafos | 15,6:1 |
| `--c-tinta-suave` | `#5b5e70` | Bajadas y textos secundarios | 6,2:1 |
| `--c-tinte` | `#eeeff8` | Fondo alterno y paneles (`#2b36a7` al 8 % sobre blanco) | — |

**Degradados** (mismos colores del sitio anterior):
- `--g-marca`: `#2b36a7 → #0fb9c3`, en las líneas de los antetítulos y los íconos de lista.
- `--g-oscuro`: `#050241 → #090979 → #009dff`, en las bandas oscuras. Se cambió el ángulo (de 318° a 115°) para que el texto, a la izquierda, quede sobre la zona oscura; con el ángulo original el blanco quedaba sobre celeste y no alcanzaba el contraste mínimo.

**Colores descartados** (venían de Bootstrap o WordPress, no de la marca): `#007bff`, `#0069d9`, `#039`, `#32373c`.

## Tipografía

**Manrope** (variable, pesos 200 a 800), licencia SIL OFL, alojada en el propio sitio (`src/assets/fonts/`, 40 KB en total).

Por qué Manrope:
- Es una sans geométrica de proporciones abiertas, del mismo carácter que Kumbh Sans (la del sitio anterior para títulos), así que la marca se reconoce. Con una sola familia variable se reemplazan las cinco que cargaba el WordPress (Kumbh Sans, Heebo, Archivo, Montserrat y Roboto).
- Funciona bien en títulos muy grandes y apretados (al estilo de Apple) y en texto corrido a 17 px.
- Cubre todos los caracteres del español y del latín extendido.
- Un solo archivo de 25 KB para el alfabeto latino, frente a cinco familias cargadas desde Google Fonts que bloqueaban el dibujado de la página.

| Nivel | Tamaño (de móvil a escritorio) | Peso |
|---|---|---|
| h1 | 36 → 64 px | 750 |
| h2 | 32 → 56 px | 750 |
| h3 / títulos de tarjeta | 20 → 24 px | 700 |
| Bajada | 18 → 22 px | 400 |
| Texto | 17 px | 400 |
| Antetítulo, menú | 15 px | 600–700 |

## Espaciado y medidas

- Escala de 4 px: 4, 8, 12, 16, 24, 32, 48, 64.
- Ancho máximo de contenido: 1200 px, con márgenes laterales de 20 a 48 px.
- Respiro entre secciones: 72 a 144 px (`--seccion`).
- Radios: 10 px (campos), 20 px (tarjetas), 28 px (imágenes grandes), píldora (botones).
- Áreas táctiles: 44 px mínimo en teléfonos.

## Componentes

| Componente | Clase | Notas |
|---|---|---|
| Botón principal | `.boton.boton--principal` | Marino; al pasar el cursor, azul con sombra; se encoge levemente al presionar |
| Botón secundario | `.boton.boton--secundario` | Contorno marino |
| Botón sobre fondo oscuro | `.boton--claro`, `.boton--contorno-claro` | |
| WhatsApp | `parciales/boton-whatsapp.njk` | Ícono en su verde propio, abre en pestaña nueva |
| Cabecera | `parciales/cabecera.njk` | Fija, translúcida; panel de servicios de 3 columnas en escritorio, menú a pantalla completa en móvil |
| Pestañas | `[data-pestanas]` | Teclado con flechas, Inicio y Fin; sin JavaScript se ven todas las líneas |
| Tarjeta de servicio | `parciales/tarjeta-servicio.njk` | Toda la tarjeta es clicable; la foto se acerca 3 % al pasar el cursor |
| Banda oscura | `.oscuro` | Partner Bibliotheca y llamado final |
| Muro de logos | `parciales/logos.njk` | 2, 3 o 4 columnas; la última fila queda centrada |
| Ficha lateral | `.ficha` | Fija al hacer scroll en escritorio |
| Formulario | `.formulario`, `.campo` | Etiquetas visibles, error bajo cada campo, mensaje de estado anunciado a lectores de pantalla |
| Pendiente | `parciales/pendiente.njk` | Recuadro punteado; se oculta con `mostrarPendientes: false` |
