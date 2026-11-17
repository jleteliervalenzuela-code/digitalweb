#!/usr/bin/env python3
"""
Arma el tema de WordPress de Digital G+ y su .zip.

Toma el diseño (CSS, JS, fuente, íconos, logos) y el contenido (src/_data/*.json)
del sitio estático, para que ambos sitios compartan una sola fuente, y genera:

  wordpress-tema/digitalgmas/importar/contenido.json   contenido para el importador
  wordpress-tema/digitalgmas/importar/img/             imágenes a importar
  wordpress-tema/digitalgmas/assets/...                diseño
  wordpress-tema/digitalgmas.zip                       archivo para subir a WordPress

Uso (desde la carpeta del proyecto):  python3 wordpress-tema/construir.py
Requiere Python 3 y Pillow (pip install pillow).
"""
import json
import re
import shutil
import zipfile
from pathlib import Path

RAIZ = Path(__file__).resolve().parent.parent
SRC = RAIZ / "src"
TEMA = RAIZ / "wordpress-tema" / "digitalgmas"
IMG_SRC = SRC / "assets" / "img"

datos_sitio = json.loads((SRC / "_data" / "sitio.json").read_text(encoding="utf8"))
datos_serv = json.loads((SRC / "_data" / "servicios.json").read_text(encoding="utf8"))
datos_cli = json.loads((SRC / "_data" / "clientes.json").read_text(encoding="utf8"))


def descripcion_de(plantilla):
    """Lee la descripción del front matter de una plantilla de Eleventy."""
    texto = (SRC / plantilla).read_text(encoding="utf8")
    m = re.search(r'^description:\s*"(.*)"\s*$', texto, re.M)
    return m.group(1) if m else ""


# ---------------------------------------------------------------- imágenes
imagenes = {}  # archivo -> {archivo, alt, titulo}


def imagen(archivo, alt=""):
    if not archivo:
        return None
    if archivo not in imagenes:
        titulo = alt or Path(archivo).stem.replace("-", " ").capitalize()
        imagenes[archivo] = {"archivo": archivo, "alt": alt, "titulo": titulo[:120]}
    elif alt and not imagenes[archivo]["alt"]:
        imagenes[archivo]["alt"] = alt
    return archivo


# ---------------------------------------------------------------- servicios
servicios = []
orden = 0
for linea in datos_serv["lineas"]:
    for s in [i for i in datos_serv["items"] if i["linea"] == linea["id"]]:
        orden += 10
        imgs = s.get("imagenes", [])
        for im in imgs:
            imagen(im["src"], im["alt"])
        servicios.append({
            "slug": s["slug"],
            "nombre": s["nombre"],
            "nombre_corto": s.get("nombreCorto", ""),
            "bajada": s.get("bajada", ""),
            "linea": linea["id"],
            "orden": orden,
            "parrafos": s["parrafos"],
            "lista_titulo": s.get("lista", {}).get("titulo", ""),
            "lista": s.get("lista", {}).get("items", []),
            "enlace_texto": s.get("enlace", {}).get("texto", ""),
            "enlace_url": s.get("enlace", {}).get("url", ""),
            "foto": imgs[0]["src"] if imgs else None,
            "galeria": [im["src"] for im in imgs[1:]],
            "franja": imagen(s.get("banner"), ""),
        })

lineas = []
for n, l in enumerate(datos_serv["lineas"], 1):
    lineas.append({
        "slug": l["id"], "nombre": l["nombre"], "descripcion": l["descripcion"],
        "imagen": imagen(l["imagen"], l["imagenAlt"]), "orden": n,
    })

clientes = [
    {"nombre": c["nombre"], "logo": imagen(c["logo"], c["nombre"]), "orden": n * 10}
    for n, c in enumerate(datos_cli, 1)
]

# Imágenes del Personalizador (mismas que usa el sitio estático)
inicio = datos_sitio["inicio"]
opciones_imagen = {
    "hero_imagen": imagen(inicio["imagen"], inicio["imagenAlt"]),
    "nosotros_imagen": imagen("lineas/equipo.png", "Profesionales trabajando con computadores portátiles"),
    "partner_foto_1": imagen("servicios/lockers-inteligentes-1.jpg"),
    "partner_foto_2": imagen("servicios/inventarios-1.jpg"),
}

paginas = [
    {"slug": "inicio", "titulo": "Inicio", "padre": None, "parrafos": [], "extracto": ""},
    {"slug": "quienes-somos", "titulo": "Quiénes somos", "padre": None,
     "parrafos": datos_sitio["quienesSomos"]["texto"], "extracto": descripcion_de("quienes-somos.njk")},
    {"slug": "nuestros-servicios", "titulo": "Nuestros servicios", "padre": None, "parrafos": [],
     "extracto": descripcion_de("nuestros-servicios.njk")},
    {"slug": "nuestros-clientes", "titulo": "Nuestros clientes", "padre": None, "parrafos": [],
     "extracto": descripcion_de("nuestros-clientes.njk")},
    {"slug": "contacto", "titulo": "Contacto", "padre": None, "parrafos": [],
     "extracto": descripcion_de("contacto.njk")},
    {"slug": "gracias", "titulo": "Solicitud enviada", "padre": "contacto", "parrafos": [], "extracto": ""},
]

contenido = {
    "sitio": {"nombre": datos_sitio["nombre"], "lema": datos_sitio["lema"]},
    "imagenes": list(imagenes.values()),
    "lineas": lineas,
    "servicios": servicios,
    "clientes": clientes,
    "paginas": paginas,
    "opciones_imagen": opciones_imagen,
}

# ---------------------------------------------------------------- copiar archivos
destino_img = TEMA / "importar" / "img"
shutil.rmtree(destino_img, ignore_errors=True)
renombrados = {}
for archivo in imagenes:
    origen = IMG_SRC / archivo
    final = destino_img / archivo
    final.parent.mkdir(parents=True, exist_ok=True)
    if origen.suffix == ".png":
        # Los PNG del sitio son fotos o láminas sin transparencia útil: como JPEG
        # pesan la cuarta parte, y el tema queda liviano para subirlo a WordPress.
        from PIL import Image
        im = Image.open(origen)
        if im.mode in ("RGBA", "LA", "P"):
            fondo = Image.new("RGB", im.size, "white")
            fondo.paste(im.convert("RGBA"), mask=im.convert("RGBA").split()[-1])
            im = fondo
        final = final.with_suffix(".jpg")
        im.convert("RGB").save(final, quality=88, optimize=True, progressive=True)
        renombrados[archivo] = str(Path(archivo).with_suffix(".jpg"))
    else:
        shutil.copy2(origen, final)
texto_json = json.dumps(contenido, ensure_ascii=False, indent=1)
for viejo, nuevo in renombrados.items():
    texto_json = texto_json.replace(f'"{viejo}"', f'"{nuevo}"')
(TEMA / "importar" / "contenido.json").write_text(texto_json, encoding="utf8")

# Diseño compartido con el sitio estático
shutil.copy2(SRC / "assets" / "css" / "estilos.css", TEMA / "assets" / "css" / "estilos.css")
shutil.copy2(SRC / "assets" / "js" / "sitio.js", TEMA / "assets" / "js" / "sitio.js")
for f in (SRC / "assets" / "fonts").iterdir():
    shutil.copy2(f, TEMA / "assets" / "fonts" / f.name)
for nombre in ("logo.png", "logo-blanco.png", "partner-bibliotheca.png", "bibliotheca-blanco.png",
               "favicon-48.png", "apple-touch-icon.png", "og.jpg"):
    shutil.copy2(IMG_SRC / "marca" / nombre, TEMA / "assets" / "img" / "marca" / nombre)
for f in (SRC / "_includes" / "iconos").iterdir():
    shutil.copy2(f, TEMA / "iconos" / f.name)

# Ajustes de estilo propios de WordPress (barra de administración, etc.)
extra = (RAIZ / "wordpress-tema" / "estilos-wordpress.css").read_text(encoding="utf8")
css = (TEMA / "assets" / "css" / "estilos.css").read_text(encoding="utf8")
(TEMA / "assets" / "css" / "estilos.css").write_text(css + "\n\n" + extra, encoding="utf8")

# ---------------------------------------------------------------- zip
zip_final = RAIZ / "wordpress-tema" / "digitalgmas.zip"
zip_final.unlink(missing_ok=True)
with zipfile.ZipFile(zip_final, "w", zipfile.ZIP_DEFLATED) as z:
    for f in sorted(TEMA.rglob("*")):
        if f.is_file() and f.name != ".DS_Store":
            z.write(f, Path("digitalgmas") / f.relative_to(TEMA))

print(f"Imágenes: {len(imagenes)} · Servicios: {len(servicios)} · Clientes: {len(clientes)}")
print(f"Tema: {zip_final} ({zip_final.stat().st_size / 1024 / 1024:.1f} MB)")
