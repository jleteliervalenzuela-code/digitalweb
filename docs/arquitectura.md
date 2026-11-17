# Arquitectura (Fase 2)

## Mapa del sitio

```
Inicio  /
├── Quiénes somos  /quienes-somos/
├── Servicios  /nuestros-servicios/
│   ├── Digitalización  /nuestros-servicios/#digitalizacion
│   │   ├── Digitalización de bibliografías            /servicio/digitalizacion-bibliografias/
│   │   ├── Digitalización de documentos               /servicio/digitalizacion-de-documentos/
│   │   └── Documentos históricos y patrimoniales      /servicio/digitalizacion-material-patrimonial/
│   ├── Productos Bibliotheca  /nuestros-servicios/#productos-bibliotheca
│   │   ├── Antenas de seguridad (RFID)                /servicio/antenas-de-seguridad-rfid/
│   │   ├── Auto préstamo                              /servicio/auto-prestamo/
│   │   ├── Auto préstamo desde el móvil (cloudLibrary)/servicio/auto-prestamo-desde-el-movil/
│   │   ├── Estanterías inteligentes                   /servicio/estanterias-inteligentes/
│   │   ├── Cuenta personas y análisis de datos        /servicio/cuenta-personas-y-analisis-de-datos/
│   │   ├── Inventarios y gestión de colecciones       /servicio/inventarios-y-gestion-de-colecciones/
│   │   └── Lockers inteligentes  (antes faltaba en el menú)  /servicio/lockers-inteligentes/
│   └── Plataformas y productos con IA  /nuestros-servicios/#plataformas-ia
│       ├── Portal de Bibliotecas                      /servicio/portal-de-bibliotecas/
│       ├── Koha: instalación y soporte                /servicio/koha-instalacion-y-soporte/
│       ├── Buscador de Bibliografías                  /servicio/buscador-bibliografias/
│       ├── Biblioteca Agéntica                        /servicio/agente-biblioteca/
│       └── Visor de PDF                               /servicio/visor-libro-ia/
├── Clientes  /nuestros-clientes/
└── Contacto  /contacto/   (→ /contacto/gracias/ cuando se envía sin JavaScript)
```

Se mantuvieron todas las direcciones del sitio anterior. Cualquier servicio queda **a un clic desde la portada** (pestañas de la portada, panel del menú o pie).

## Navegación

- **Cabecera fija:** Inicio · Quiénes somos · Servicios (panel con las 3 líneas y los 15 servicios) · Clientes · Contacto · botón **Solicitar cotización** siempre visible en escritorio.
- **Móvil:** menú a pantalla completa con Servicios desplegable y los botones Solicitar cotización y WhatsApp.
- **Pie:** los 15 servicios agrupados, correo, teléfono y enlaces del sitio.
- **Migas de pan** en todas las páginas interiores.
- **Llamado a la acción:** principal «Solicitar cotización» (formulario, con el servicio preseleccionado si se llega desde una ficha) y secundario «Escribir por WhatsApp» (+56 9 7389 1319).

## Estructura de cada página (wireframe en texto)

**Inicio**
1. Hero fijo (reemplaza el slider): antetítulo «Partner Bibliotheca», h1, bajada, [Solicitar cotización] [WhatsApp], sello «Partner de Bibliotheca» y «19 instituciones confían en nosotros». Foto de autopréstamo a la derecha.
2. Qué hacemos: pestañas Digitalización / Productos Bibliotheca / Plataformas con IA. Cada pestaña: imagen grande, bajada de la línea y lista de sus servicios con enlace.
3. Banda oscura Partner Bibliotheca: logo, «Somos distribuidor de Bibliotheca en Chile», [Ver productos Bibliotheca], dos fotos de producto.
4. Quiénes somos (resumen): título, objetivo de la empresa, [Más sobre Digital G+], imagen.
5. Clientes: «Ellos confían en nosotros», muro de 19 logos.
6. Cierre oscuro: «Hablemos de tu biblioteca», [Solicitar cotización] [WhatsApp], correo y teléfono.

**Quiénes somos:** migas · h1 · texto institucional + imagen · recuadros [PENDIENTE] de misión, visión y equipo · banda Partner Bibliotheca · cierre.

**Servicios:** migas · h1 + atajos a las 3 líneas · una sección por línea (título, bajada, tarjetas de sus servicios) · cierre.

**Ficha de servicio (15, una sola plantilla):** migas · línea + h1 + bajada + [Solicitar cotización] [WhatsApp] con foto a la derecha (o franja de banner si el servicio no tiene foto) · texto del servicio, lista «Entre las acciones que contempla el servicio», galería · bloque lateral fijo «¿Te interesa este servicio?» con botones y enlace a Bibliotheca o Koha · «Otros servicios de esta línea» · cierre.

**Clientes:** migas · h1 · muro de logos · cierre.

**Contacto:** migas · h1 «Solicita una cotización» · formulario (nombre, correo, institución, cargo, teléfono, servicio de interés, consulta) · canales: WhatsApp, teléfono, correo · [PENDIENTE] dirección y horario.

**404 y Gracias:** mensaje y dos botones de salida.

## Elección del generador

| Opción | A favor | En contra |
|---|---|---|
| HTML puro | Cero herramientas | Cabecera y pie repetidos en 21 páginas; agregar un servicio obliga a tocar varios HTML; sin optimización de imágenes |
| **Eleventy (elegido)** | Licencia MIT; genera HTML puro sin JavaScript de framework en el navegador; cabecera y pie una sola vez; contenido en JSON; fichas generadas desde los datos; convierte imágenes a AVIF/WebP; plantillas legibles | Requiere Node.js para compilar (lo hace GitHub Actions al publicar) |
| Astro | Muy potente, componentes | Más conceptos y archivos de los que este sitio necesita; más difícil de editar a mano |

## Formulario

FormSubmit (gratuito, sin límite de envíos, sin registro). Detalle de activación y límites en el README, sección 3.
