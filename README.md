# Sitio web de Digital G+ (digitalgmas.cl)

Sitio estático (HTML, CSS y JavaScript) generado con [Eleventy](https://www.11ty.dev/) y publicado en GitHub Pages. No tiene CMS, base de datos ni panel de administración: **todo se edita modificando archivos de texto**, a mano o pidiéndoselo a Claude.

---

## 1. Estructura de carpetas

```
digitalgmas-sitio/
├── src/                          ← TODO lo que se edita está aquí
│   ├── _data/                    ← CONTENIDO (archivos JSON)
│   │   ├── sitio.json            ← datos generales, contacto, textos de portada y Quiénes somos, GTM, formulario
│   │   ├── servicios.json        ← las 3 líneas y los 15 servicios (textos, fotos, enlaces)
│   │   ├── clientes.json         ← lista de logos de clientes
│   │   ├── redirecciones.json    ← direcciones antiguas que llevan a las nuevas
│   │   └── build.js              ← versión y fecha de compilación (no se edita)
│   ├── _includes/
│   │   ├── base.njk              ← plantilla común: <head>, GTM, metadatos
│   │   ├── parciales/
│   │   │   ├── cabecera.njk      ← encabezado y menú (definido una sola vez)
│   │   │   ├── pie.njk           ← pie de página (definido una sola vez)
│   │   │   ├── cierre.njk        ← bloque final "Hablemos de tu biblioteca"
│   │   │   ├── tarjeta-servicio.njk, logos.njk, boton-whatsapp.njk, pendiente.njk
│   │   └── iconos/               ← íconos SVG (Lucide y WhatsApp)
│   ├── assets/
│   │   ├── css/estilos.css       ← TODO el diseño (colores y tipografía al inicio)
│   │   ├── js/sitio.js           ← menú, pestañas, animaciones, formulario
│   │   ├── fonts/                ← fuente Manrope (alojada en el sitio)
│   │   └── img/                  ← imágenes originales (marca, clientes, servicios, lineas)
│   ├── index.njk                 ← Inicio
│   ├── quienes-somos.njk
│   ├── nuestros-servicios.njk
│   ├── nuestros-clientes.njk
│   ├── contacto.njk  ·  contacto/gracias.njk
│   ├── servicio.njk              ← plantilla de TODAS las fichas de servicio
│   ├── 404.njk, redirecciones.njk, sitemap.njk, robots.njk
│   └── CNAME                     ← dominio digitalgmas.cl para GitHub Pages
├── docs/                         ← auditoría, decisiones, textos nuevos y correcciones
├── .github/workflows/publicar.yml← publicación automática en GitHub Pages
├── eleventy.config.js            ← configuración (imágenes, filtros)
└── package.json
```

`_site/` es el sitio terminado que genera Eleventy. No se edita ni se sube al repositorio.

---

## 2. Cómo editar cada sección

Después de cualquier cambio, revisa el resultado en tu computador (sección 4) y súbelo (sección 5).

### Textos de la portada y de Quiénes somos
`src/_data/sitio.json` → campos `inicio` (título, bajada, imagen) y `quienesSomos` (párrafos).

### Correo, teléfono, WhatsApp
`src/_data/sitio.json` → `contacto`. Se actualizan solos en la cabecera, el pie, el bloque final y Contacto.

### Agregar o cambiar un servicio
1. Sube las fotos a `src/assets/img/servicios/` (JPG o PNG, idealmente de 1600 px de ancho o más).
2. En `src/_data/servicios.json`, dentro de `items`, copia un servicio existente y cambia:
   - `slug`: la dirección (`/servicio/<slug>/`), sin tildes ni espacios.
   - `linea`: `digitalizacion`, `productos-bibliotheca` o `plataformas-ia`.
   - `nombre`, `parrafos`, `lista` (opcional), `enlace` (opcional), `banner`, `imagenes` (cada una con su `alt`).
3. Listo: el servicio aparece en el menú, el pie, la portada, la página de servicios, el formulario y el mapa del sitio, sin tocar ningún HTML. El orden en el archivo es el orden en el sitio.

### Agregar un cliente
1. Sube el logo a `src/assets/img/clientes/` (mismo formato que los actuales: 850 × 464 px, fondo blanco).
2. Agrega una línea en `src/_data/clientes.json` con `nombre` y `logo`. El número «19 instituciones» de la portada se actualiza solo.

### Cambiar colores o tipografía
`src/assets/css/estilos.css`, sección 2 «Tokens». Ver `docs/sistema-de-diseno.md`.

### Textos marcados [PENDIENTE]
Misión, visión, equipo, dirección y horario no existían en el sitio anterior y se muestran como recuadros punteados **[PENDIENTE]**.
- Para completarlos, escribe el texto en `src/_data/sitio.json` (`quienesSomos.mision`, `vision`, `equipo`; `contacto.direccion`, `horario`) y pídele a Claude que los muestre en la página.
- Para ocultar todos los recuadros antes de lanzar, cambia `"mostrarPendientes": true` a `false` en `src/_data/sitio.json`.

### Google Tag Manager
`src/_data/sitio.json` → `gtm` (`GTM-PCLFRV6`). Solo se carga en el sitio publicado, no en las pruebas locales.

### Redirecciones de direcciones antiguas
`src/_data/redirecciones.json`. Ver la sección 7.

---

## 3. Formulario de contacto (FormSubmit)

Un sitio estático no puede enviar correos, así que el formulario usa **FormSubmit** (formsubmit.co), un servicio gratuito, sin registro y sin límite de envíos, que reenvía cada mensaje a `contacto@digitalgmas.cl`.

**Activación (una sola vez, después de publicar):**
1. Envía un mensaje de prueba desde `https://digitalgmas.cl/contacto/`.
2. Llegará a `contacto@digitalgmas.cl` un correo de FormSubmit pidiendo confirmar. Confírmalo. Hasta entonces los mensajes no se entregan.
3. FormSubmit te entregará una **cadena aleatoria** (alias). Reemplaza el correo en `src/_data/sitio.json` → `formulario.accion`:
   `"https://formsubmit.co/contacto@digitalgmas.cl"` → `"https://formsubmit.co/<tu-cadena>"`.
   Así el correo no queda visible en el código para los robots.

**Protección antispam:** campo trampa oculto (`_honey`), rechazo de envíos hechos en menos de 3 segundos y validación de campos.

**Límites que debes conocer:**
- Es un servicio de un tercero, gratuito y sin garantía de disponibilidad. Si deja de funcionar, el formulario mostrará un mensaje de error con el correo de contacto.
- Los datos del formulario pasan por los servidores de FormSubmit antes de llegar al correo. La nota del formulario lo informa; revísala frente a vuestra política de datos personales (Ley 21.719).
- Alternativa si se necesita otro proveedor: Web3Forms (gratis hasta 250 envíos al mes). Basta con cambiar `formulario.accion` y adaptar la función de envío en `src/assets/js/sitio.js`.

Sin JavaScript el formulario también funciona: FormSubmit recibe el envío y devuelve al visitante a `/contacto/gracias/`.

---

## 4. Ver el sitio en tu computador

Requiere [Node.js](https://nodejs.org/) 20 o superior.

```bash
npm install        # solo la primera vez
npm run dev        # abre http://localhost:8080 y se actualiza al guardar
```

La primera compilación tarda alrededor de un minuto porque genera las imágenes en AVIF y WebP; las siguientes son instantáneas.

---

## 5. Publicar en GitHub Pages

### Primera vez
1. Crea un repositorio vacío en GitHub y sube esta carpeta:
   ```bash
   git remote add origin https://github.com/<usuario>/<repositorio>.git
   git push -u origin main
   ```
2. En el repositorio: **Settings → Pages → Build and deployment → Source: GitHub Actions**.
3. El flujo `.github/workflows/publicar.yml` compila y publica. Revisa el avance en la pestaña **Actions**.
4. **Dominio propio** (Settings → Pages → Custom domain: `digitalgmas.cl`; recuerda cambiar `RUTA_BASE` a `/`, ver más abajo). En el proveedor del dominio, apunta los registros DNS según la guía oficial de GitHub ([docs.github.com → Managing a custom domain](https://docs.github.com/es/pages/configuring-a-custom-domain-for-your-github-pages-site/managing-a-custom-domain-for-your-github-pages-site)): registros `A` del dominio raíz hacia las IP de GitHub Pages y `CNAME` de `www` hacia `<usuario>.github.io`. Luego activa **Enforce HTTPS**.
5. Cambiar el DNS desconecta el WordPress actual. Antes de hacerlo, revisa la lista de la sección 8.

### Dirección de GitHub y dominio propio (`RUTA_BASE`)
Mientras el sitio se publica en `https://jleteliervalenzuela-code.github.io/digitalweb/`, todas sus rutas deben empezar con `/digitalweb/`. Eso lo define la línea `RUTA_BASE: /digitalweb/` de `.github/workflows/publicar.yml`.

**Al conectar `digitalgmas.cl`, cambia esa línea a `RUTA_BASE: /`** en el mismo commit en que configuras el dominio. Si no, el sitio se verá sin estilos ni imágenes en el dominio propio.

Para probarlo en tu computador como en GitHub: `RUTA_BASE=/digitalweb/ npx @11ty/eleventy --serve` y abre `http://localhost:8080/digitalweb/`.

### Cambios posteriores
Cada `git push` a `main` vuelve a publicar automáticamente en uno o dos minutos.

---

## 6. Dependencias y licencias

Todas gratuitas y de código abierto. No hay librerías en el navegador: el JavaScript del sitio es propio (≈ 9 KB).

| Dependencia | Para qué | Licencia | Dónde corre |
|---|---|---|---|
| Eleventy 3 | Generar el HTML | MIT | Solo al compilar |
| @11ty/eleventy-img 7 | Convertir imágenes a AVIF/WebP | MIT | Solo al compilar |
| sharp (dependencia de la anterior) | Procesar imágenes | Apache-2.0 | Solo al compilar |
| Manrope (fuente) | Tipografía | SIL OFL 1.1 | En el sitio, archivo propio |
| Lucide (íconos) | Íconos de línea | ISC | En el sitio, SVG copiados |
| Simple Icons (ícono WhatsApp) | Ícono de WhatsApp | CC0 1.0 (la marca WhatsApp es de Meta) | En el sitio, SVG copiado |

Servicios externos: FormSubmit (formulario) y Google Tag Manager (analítica). Ninguna fuente, ícono ni librería se carga desde terceros.

---

## 7. Redirecciones

Se conservaron todas las direcciones de páginas y servicios del sitio anterior (`/quienes-somos/`, `/servicio/lockers-inteligentes/`, etc.), así que la mayoría de los enlaces antiguos siguen funcionando sin redirección.

Las 9 direcciones que desaparecen (archivos de WordPress, categorías, fichas duplicadas y páginas de prueba) redirigen a la nueva según `src/_data/redirecciones.json`. **GitHub Pages no permite redirecciones 301 de servidor**: cada una es una página mínima con `meta refresh` y enlace canónico, que Google trata como redirección permanente. Si alguna vez se necesitan 301 reales, se puede poner Cloudflare (plan gratuito) delante del dominio.

Detalle completo: `docs/migracion.md`.

---

## 8. Antes de cambiar el DNS (lista de lanzamiento)

- [ ] Confirmar los textos nuevos (`docs/textos-nuevos.md`) y las correcciones marcadas [CONFIRMAR] (`docs/correcciones-de-texto.md`).
- [ ] Confirmar los nombres de los 19 clientes en `src/_data/clientes.json` (fueron deducidos de los logos).
- [ ] Completar u ocultar los recuadros [PENDIENTE] (`mostrarPendientes`).
- [ ] Publicar, enviar un mensaje de prueba y activar FormSubmit (sección 3).
- [ ] Revisar en Google Tag Manager que el contenedor `GTM-PCLFRV6` registre visitas en el sitio nuevo.
- [ ] Cambiar el DNS y activar HTTPS.
- [ ] En Google Search Console, enviar `https://digitalgmas.cl/sitemap.xml`.

---

## 9. Documentación del proyecto

| Archivo | Contenido |
|---|---|
| `docs/fase-1-auditoria.md` | Auditoría del sitio anterior, paleta e inventario completo de contenido |
| `docs/arquitectura.md` | Mapa del sitio, navegación, estructura de cada página y elección del generador |
| `docs/sistema-de-diseno.md` | Colores, tipografía, espaciado y componentes |
| `docs/migracion.md` | URLs antiguas y nuevas, redirecciones e imágenes |
| `docs/auditoria-final.md` | Auditoría final: problemas por severidad, correcciones y mediciones |
| `docs/textos-nuevos.md` | Textos que no existían y hay que validar |
| `docs/correcciones-de-texto.md` | Correcciones aplicadas al texto original, con el original al lado |
