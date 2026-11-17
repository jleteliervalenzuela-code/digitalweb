# Migración desde WordPress

Inventario tomado del sitemap de Yoast y del código fuente descargado el 16-11-2026. El inventario completo de textos e imágenes del sitio anterior está en `docs/fase-1-auditoria.md`.

## URLs: antes y después

| URL anterior | Estado anterior | Sitio nuevo |
|---|---|---|
| `/` | 200 | Se mantiene |
| `/quienes-somos/` | 200 | Se mantiene |
| `/nuestros-servicios/` | 200 | Se mantiene |
| `/nuestros-clientes/` | 200 | Se mantiene |
| `/contacto/` | 200 | Se mantiene |
| `/servicio/<15 servicios del menú>/` | 200 | Se mantienen las 15 con la misma dirección |
| `/servicio/lockers-inteligentes/` | 200, fuera del menú | Se mantiene y ahora está en el menú |
| `/servicio/` | 200 (archivo de WordPress) | Redirige a `/nuestros-servicios/` |
| `/servicio/page/2/` | 200 | Redirige a `/nuestros-servicios/` |
| `/servicio/biblioteca-agentica/` | 200 (duplicado) | Redirige a `/servicio/agente-biblioteca/` |
| `/servicio/buscador-de-bibliografias/` | 200 (duplicado) | Redirige a `/servicio/buscador-bibliografias/` |
| `/category/digitalizacion/` | 301 | Redirige a `/nuestros-servicios/#digitalizacion` |
| `/category/productos-bibliotheca/` | 301 | Redirige a `/nuestros-servicios/#productos-bibliotheca` |
| `/category/plataformas-y-productos-con-ia-inteligencia-artificial/` | 301 | Redirige a `/nuestros-servicios/#plataformas-ia` |
| `/pagina-de-ejemplo/` | 200 (página de muestra de WordPress) | Redirige a `/` |
| `/super-simple-slider/slider-escritorio/` | 200 (página técnica del plugin) | Redirige a `/` |
| — | — | Nuevas: `/contacto/gracias/`, `/404.html`, `/sitemap.xml`, `/robots.txt` |

Las redirecciones están en `src/_data/redirecciones.json`. GitHub Pages no hace 301 de servidor: cada una es una página con `meta refresh` inmediato y `rel="canonical"` hacia la nueva dirección (ver README, sección 7).

Direcciones de WordPress que dejarán de existir sin redirección: `/wp-admin/`, `/wp-json/…`, `/feed/`, `/wp-content/uploads/…` (archivos sueltos). Ninguna estaba enlazada para visitantes.

## Imágenes

Todas vienen del sitio anterior (`digitalgmas.cl/wp-content/uploads/`). Las 10 que el WordPress cargaba desde el dominio de pruebas `digitalgmas.disenositioweb.cl` se recuperaron del dominio principal. Originales en `src/assets/img/`:

- `marca/`: logo (recortado del JPG original, fondo transparente), logo blanco, isotipo, sello «Partner de Bibliotheca», logo blanco de Bibliotheca, ícono y la imagen para compartir `og.jpg` (1200 × 630, armada con el logo).
- `clientes/`: 19 logos (850 × 464).
- `servicios/`: banners de cabecera (1900 × 300) y fotos de producto (hasta 900 px, diagramas de IA de 1600 px).
- `lineas/`: imagen de Quiénes somos.

Eleventy genera para cada imagen versiones AVIF, WebP y JPEG/PNG en varios anchos, con carga diferida salvo la imagen principal de cada página.

Material de la biblioteca de medios que no se usó porque no aparecía en el sitio publicado: `01_comics`, `02_catalogo`, `02_libros`, `05_insumos`, `img_insumos`, `04_img`, `01_digital` y algunos fondos. Quedan disponibles en la descarga de la Fase 1 si se necesitan.

## Google Tag Manager

Se mantiene el contenedor `GTM-PCLFRV6` en todas las páginas (script en `<head>` y `noscript` al inicio de `<body>`). El formulario envía el evento `formulario_enviado` a `dataLayer` cuando un envío se completa, para poder medir conversiones.
