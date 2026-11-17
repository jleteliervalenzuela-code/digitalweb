# Auditoría final (Fase 5)

Fecha: 17-11-2026. Herramientas: Lighthouse 12.8 (perfil móvil), Chrome sin interfaz con Playwright (contraste de cada texto, navegación con teclado, menús, pestañas, formulario con envío simulado, sin JavaScript, movimiento reducido, áreas táctiles, desborde a 320 px) y revisión estática de las 31 páginas generadas (enlaces, anclas, un h1 por página, orden de encabezados, alt, ancho y alto de imágenes, grafía de la marca).

> La skill `/impeccable` se cargó, pero llegó sin sus scripts ni archivos de referencia; la auditoría siguió sus criterios con las herramientas indicadas.

## Problemas encontrados y corregidos

| Severidad | Problema | Corrección | Estado |
|---|---|---|---|
| Crítica | En móvil, el menú a pantalla completa quedaba recortado dentro de la cabecera y dejaba ver la página detrás (el desenfoque `backdrop-filter` de la cabecera hacía de contenedor del menú fijo) | El fondo translúcido pasó a un pseudo-elemento de la cabecera | Corregido |
| Alta | El mapa del sitio solo listaba 6 URLs: faltaban 14 de las 15 fichas de servicio | `addAllPagesToCollections` en la plantilla de fichas; ahora lista 20 | Corregido |
| Alta | Sin JavaScript solo se veía 1 de las 3 líneas de servicio en la portada | Los paneles se ocultan desde JavaScript, no desde el HTML | Corregido |
| Alta | La imagen para compartir en redes de cada ficha apuntaba a un archivo que no se publicaba | Se publican los originales de servicios | Corregido |
| Alta | La sección «Otros servicios de esta línea» salía vacía (atajo de imagen asíncrono dentro de un bucle) | Bucle asíncrono y filtro previo | Corregido |
| Alta | Fotos de producto agrandadas a 1200 px cuando el original mide 800–900 px (pérdida de nitidez) | Cabecera de ficha en dos columnas; foto a su tamaño real | Corregido |
| Media | Al abrir «Servicios» con teclado, el siguiente Tab no entraba al panel | El panel se movió junto a su botón en el orden del documento | Corregido |
| Media | La nota del formulario no informaba que los datos pasan por un servicio externo | Nota nueva que menciona FormSubmit | Corregido |
| Media | Espacio excesivo entre la cabecera de página y la primera sección | Respiro reducido después de `.cabeza-pagina` | Corregido |
| Media | En el degradado oscuro original, el texto blanco quedaba sobre celeste (bajo el contraste mínimo) | Mismo degradado con otro ángulo | Corregido |
| Media | Las pestañas de la portada escondían la tercera opción en teléfonos | Se apilan en pantallas angostas | Corregido |
| Baja | Enlaces del pie, atajos y logo bajo 44 px de alto en teléfonos | Mínimo de 44 px en pantallas táctiles | Corregido |
| Baja | Logo y sello de Bibliotheca con rectángulo blanco sobre el fondo | Fondo exterior transparente | Corregido |
| Baja | Atributos `class="undefined"` y `fetchpriority="undefined"` en imágenes | Solo se escriben atributos con valor | Corregido |

**Pendientes:** ninguno crítico ni alto. Quedan 9 avisos automáticos de área táctil que son falsos positivos (el título de cada tarjeta mide 27 px, pero su enlace cubre toda la tarjeta).

## Verificado sin problemas

- Contraste: ningún texto bajo 4,5:1 (o 3:1 en texto grande) en 8 páginas.
- Teclado: el primer Tab llega a «Saltar al contenido»; foco visible en todos los controles; Escape cierra menús; las pestañas responden a las flechas, Inicio y Fin.
- Formulario: muestra los 3 errores de campos obligatorios bajo cada campo y lleva el foco al primero; preselecciona el servicio al llegar desde una ficha; envía por AJAX a FormSubmit; muestra confirmación tras un envío correcto y un mensaje con el correo si falla.
- Sin desborde horizontal a 320, 360, 768, 1280 y 1920 px.
- Movimiento reducido: no hay animaciones y nada queda oculto.
- Enlaces internos y anclas: 0 rotos. Los 8 enlaces externos son los mismos del sitio anterior (Bibliotheca responde 403 a robots, así que no se pudo comprobar desde aquí que abran bien).
- Un h1 por página, sin saltos de nivel, todas las imágenes con alt, ancho y alto.
- La marca se escribe «Digital G+» en todo el sitio.

## Antes y después

Lighthouse, perfil móvil. **Las condiciones no son idénticas:** el sitio anterior se midió en vivo por internet y el nuevo en un servidor local sin GTM, así que los tiempos favorecen al nuevo. El peso de página y las puntuaciones de accesibilidad son comparables.

| Página | Rendimiento | Accesibilidad | Buenas prácticas | SEO | LCP | Peso |
|---|---|---|---|---|---|---|
| Inicio, antes | 48 | 94 | 96 | 100 | 17,4 s | 3534 KB |
| Inicio, después | 98 | 100 | 100 | 100 | 2,4 s | 279 KB |
| Lockers, antes | 71 | 91 | 96 | 92 | 3,6 s | 1208 KB |
| Lockers, después | 99 | 100 | 100 | 100 | 2,1 s | 304 KB |
| Contacto, antes | 45 | 98 | 100 | 100 | 6,1 s | 788 KB |
| Contacto, después | 100 | 100 | 100 | 100 | 1,7 s | 141 KB |

Otros cambios frente al sitio anterior:
- El sitio anterior tenía desborde horizontal: a 360 px su página medía 512 px de ancho (se podía arrastrar hacia los lados en el teléfono).
- Slider de 3 láminas con «Ver más» rotos → hero fijo con un mensaje y dos botones.
- Ningún botón de contacto en el cuerpo de la portada → «Solicitar cotización» en el hero, en la cabecera, en cada ficha y al final de cada página.
- Lockers inteligentes fuera del menú → en el menú, el pie y la portada.
- Cinco grafías de la marca → una sola.
- 18 imágenes sin alt y varias con el nombre de archivo como alt → todas con texto descriptivo (o vacío si son decorativas).
- Cinco familias tipográficas desde Google Fonts → una fuente variable alojada en el sitio.

Las capturas comparativas están en la entrega (`antes-despues/`).

## Lo que no se pudo verificar

- Envío real de un mensaje a `contacto@digitalgmas.cl` (se simuló la respuesta de FormSubmit; el envío real requiere publicar y activar el servicio).
- Funcionamiento de GTM en el sitio publicado (el contenedor está en el HTML de producción, verificado en el código).
- Prueba con lectores de pantalla reales (NVDA, VoiceOver) y en Safari o iOS reales.
