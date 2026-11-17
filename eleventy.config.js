// =============================================================
// Configuración de Eleventy (generador de sitio estático)
// -------------------------------------------------------------
// Eleventy lee las plantillas de /src y los datos de /src/_data,
// y escribe el sitio terminado (HTML plano) en /_site.
// GitHub Pages publica el contenido de /_site.
// =============================================================

import Image from "@11ty/eleventy-img";
import { HtmlBasePlugin } from "@11ty/eleventy";
import path from "node:path";
import fs from "node:fs";

export default function (eleventyConfig) {
  // Antepone la carpeta base (pathPrefix, más abajo) a los enlaces e imágenes del HTML
  eleventyConfig.addPlugin(HtmlBasePlugin);

  // --- Archivos que se copian tal cual al sitio final ---------
  eleventyConfig.addPassthroughCopy({ "src/assets/fonts": "assets/fonts" });
  eleventyConfig.addPassthroughCopy({ "src/assets/css": "assets/css" });
  eleventyConfig.addPassthroughCopy({ "src/assets/js": "assets/js" });
  eleventyConfig.addPassthroughCopy({ "src/assets/img/marca": "assets/img/marca" });
  // Originales de servicios: se usan como imagen para compartir en redes (og:image)
  eleventyConfig.addPassthroughCopy({ "src/assets/img/servicios": "assets/img/servicios" });
  eleventyConfig.addPassthroughCopy({ "src/CNAME": "CNAME" });
  eleventyConfig.addPassthroughCopy({ "src/.nojekyll": ".nojekyll" });

  // --- Íconos SVG en línea: {% icono "arrow-right" %} ----------
  // Los SVG están en src/_includes/iconos/ (Lucide, licencia ISC;
  // WhatsApp de Simple Icons, CC0).
  eleventyConfig.addShortcode("icono", (nombre, clase = "icono") => {
    const archivo = path.join("src/_includes/iconos", `${nombre}.svg`);
    const svg = fs.readFileSync(archivo, "utf8");
    return svg.replace("<svg", `<svg class="${clase}"`);
  });

  // --- Imágenes responsivas: {% imagen "ruta", "alt", "sizes" %} -
  // Genera AVIF, WebP y JPEG/PNG en varios anchos y escribe <picture>.
  // La ruta es relativa a src/assets/img/.
  eleventyConfig.addShortcode(
    "imagen",
    async function (src, alt, sizes = "100vw", opciones = {}) {
      if (alt === undefined) {
        throw new Error(`Falta el texto alternativo (alt) en la imagen ${src}`);
      }
      const origen = path.join("src/assets/img", src);
      const esPng = src.endsWith(".png");
      const metadatos = await Image(origen, {
        widths: opciones.anchos || [480, 900, 1600, "auto"],
        formats: ["avif", "webp", esPng ? "png" : "jpeg"],
        outputDir: "_site/assets/img/generadas/",
        urlPath: "/assets/img/generadas/",
        sharpAvifOptions: { quality: 55 },
        sharpWebpOptions: { quality: 75 },
        sharpJpegOptions: { quality: 78, progressive: true },
      });
      const prioritaria = opciones.prioridad === true;
      const atributos = { alt, sizes, loading: prioritaria ? "eager" : "lazy", decoding: "async" };
      if (prioritaria) atributos.fetchpriority = "high";
      if (opciones.clase) atributos.class = opciones.clase;
      return Image.generateHTML(metadatos, atributos);
    }
  );

  // --- Filtros útiles en las plantillas -------------------------
  // Servicios de una línea: {{ servicios.items | deLinea("digitalizacion") }}
  eleventyConfig.addFilter("deLinea", (items, linea) =>
    items.filter((i) => i.linea === linea)
  );
  // Quita un servicio de una lista (para "Otros servicios de esta línea")
  eleventyConfig.addFilter("sinSlug", (items, slug) => items.filter((i) => i.slug !== slug));
  // Busca la línea de un servicio por su id
  eleventyConfig.addFilter("lineaPorId", (lineas, id) =>
    lineas.find((l) => l.id === id)
  );
  // Recorta un texto a la primera oración (para metadescripciones)
  eleventyConfig.addFilter("primeraOracion", (texto = "") => {
    const corte = texto.indexOf(". ");
    const frase = corte > 0 ? texto.slice(0, corte + 1) : texto;
    return frase.length > 160 ? frase.slice(0, 157).trimEnd() + "…" : frase;
  });
  // ¿Es un texto pendiente? (empieza por [PENDIENTE])
  eleventyConfig.addFilter("esPendiente", (texto) =>
    typeof texto === "string" && texto.startsWith("[PENDIENTE]")
  );
  eleventyConfig.addFilter("fechaISO", (fecha) =>
    new Date(fecha).toISOString().slice(0, 10)
  );

  // GTM solo se carga en la versión publicada (no en pruebas locales)
  eleventyConfig.addGlobalData(
    "entorno",
    process.env.ELEVENTY_ENV === "pruebas" ? "pruebas" : "produccion"
  );

  return {
    // Carpeta base del sitio. En GitHub Pages sin dominio propio el sitio vive en
    // /digitalweb/; con digitalgmas.cl vive en /. Se define con la variable RUTA_BASE
    // (ver .github/workflows/publicar.yml). Eleventy antepone esta ruta a todos los
    // enlaces e imágenes del HTML que empiezan con "/".
    pathPrefix: process.env.RUTA_BASE || "/",
    dir: { input: "src", output: "_site", includes: "_includes", data: "_data" },
    htmlTemplateEngine: "njk",
    markdownTemplateEngine: "njk",
    templateFormats: ["njk", "md"],
  };
}
