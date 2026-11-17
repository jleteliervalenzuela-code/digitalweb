/* =============================================================
   Digital G+ · JavaScript del sitio (sin librerías)
   -------------------------------------------------------------
   1. Menú móvil (pantalla completa)
   2. Panel de servicios del menú de escritorio
   3. Pestañas de líneas de servicio (portada)
   4. Aparición suave al hacer scroll
   5. Formulario de contacto: validación y envío a FormSubmit
   Todo el contenido funciona sin JavaScript; este archivo solo
   mejora la experiencia.
   ============================================================= */
(function () {
  "use strict";

  var reducirMovimiento = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  /* ---------- 1. Menú móvil ---------------------------------- */
  var botonMenu = document.querySelector("[data-menu]");
  var menuMovil = document.getElementById("menu-movil");
  function cerrarMenuMovil(devolverFoco) {
    if (!botonMenu || botonMenu.getAttribute("aria-expanded") !== "true") return;
    botonMenu.setAttribute("aria-expanded", "false");
    botonMenu.setAttribute("aria-label", "Abrir menú");
    menuMovil.hidden = true;
    document.body.classList.remove("menu-abierto");
    if (devolverFoco) botonMenu.focus();
  }
  if (botonMenu && menuMovil) {
    botonMenu.addEventListener("click", function () {
      var abrir = botonMenu.getAttribute("aria-expanded") !== "true";
      if (!abrir) return cerrarMenuMovil(false);
      botonMenu.setAttribute("aria-expanded", "true");
      botonMenu.setAttribute("aria-label", "Cerrar menú");
      menuMovil.hidden = false;
      document.body.classList.add("menu-abierto");
    });
    // Si la ventana crece a escritorio, el menú móvil se cierra
    window.matchMedia("(min-width: 64rem)").addEventListener("change", function (e) {
      if (e.matches) cerrarMenuMovil(false);
    });
  }

  /* ---------- 2. Panel de servicios (escritorio) ------------- */
  var botonPanel = document.querySelector("[data-panel]");
  var panel = document.getElementById("panel-servicios");
  var temporizador;
  function abrirPanel() {
    clearTimeout(temporizador);
    botonPanel.setAttribute("aria-expanded", "true");
    panel.hidden = false;
  }
  function cerrarPanel(devolverFoco) {
    clearTimeout(temporizador);
    if (botonPanel.getAttribute("aria-expanded") !== "true") return;
    botonPanel.setAttribute("aria-expanded", "false");
    panel.hidden = true;
    if (devolverFoco) botonPanel.focus();
  }
  if (botonPanel && panel) {
    botonPanel.addEventListener("click", function () {
      botonPanel.getAttribute("aria-expanded") === "true" ? cerrarPanel(false) : abrirPanel();
    });
    // Con mouse, el panel también se abre al pasar por encima
    if (window.matchMedia("(hover: hover) and (pointer: fine)").matches) {
      var zona = [botonPanel, panel];
      zona.forEach(function (el) {
        el.addEventListener("mouseenter", function () {
          clearTimeout(temporizador);
          temporizador = setTimeout(abrirPanel, 120);
        });
        el.addEventListener("mouseleave", function () {
          clearTimeout(temporizador);
          temporizador = setTimeout(function () { cerrarPanel(false); }, 220);
        });
      });
    }
    // Se cierra al salir con el teclado o al hacer clic fuera
    document.addEventListener("click", function (e) {
      if (!panel.contains(e.target) && !botonPanel.contains(e.target)) cerrarPanel(false);
    });
    panel.addEventListener("focusout", function (e) {
      if (e.relatedTarget && !panel.contains(e.relatedTarget) && e.relatedTarget !== botonPanel) cerrarPanel(false);
    });
  }

  // Escape cierra cualquier menú abierto
  document.addEventListener("keydown", function (e) {
    if (e.key !== "Escape") return;
    if (panel && !panel.hidden) cerrarPanel(true);
    cerrarMenuMovil(true);
  });

  /* ---------- 3. Pestañas ------------------------------------ */
  document.querySelectorAll("[data-pestanas]").forEach(function (grupo) {
    var pestanas = Array.prototype.slice.call(grupo.querySelectorAll('[role="tab"]'));
    var paneles = pestanas.map(function (p) { return document.getElementById(p.getAttribute("aria-controls")); });
    // En el HTML todos los paneles son visibles (así se ven sin JavaScript); aquí se ocultan los inactivos
    paneles.forEach(function (panel) { if (panel.hasAttribute("data-oculto")) panel.hidden = true; });
    function activar(indice, moverFoco) {
      pestanas.forEach(function (p, i) {
        var activa = i === indice;
        p.setAttribute("aria-selected", activa ? "true" : "false");
        p.tabIndex = activa ? 0 : -1;
        paneles[i].hidden = !activa;
      });
      if (moverFoco) pestanas[indice].focus();
      // Muestra al instante el contenido del panel recién abierto
      paneles[indice].querySelectorAll(".revelar").forEach(function (el) { el.classList.add("visible"); });
    }
    pestanas.forEach(function (p, i) {
      p.addEventListener("click", function () { activar(i, false); });
      p.addEventListener("keydown", function (e) {
        var destino = null;
        if (e.key === "ArrowRight") destino = (i + 1) % pestanas.length;
        if (e.key === "ArrowLeft") destino = (i - 1 + pestanas.length) % pestanas.length;
        if (e.key === "Home") destino = 0;
        if (e.key === "End") destino = pestanas.length - 1;
        if (destino !== null) { e.preventDefault(); activar(destino, true); }
      });
    });
  });

  /* ---------- 4. Aparición al hacer scroll ------------------- */
  var revelables = document.querySelectorAll(".revelar");
  if (!reducirMovimiento && "IntersectionObserver" in window) {
    var observador = new IntersectionObserver(function (entradas) {
      entradas.forEach(function (entrada) {
        if (entrada.isIntersecting) {
          entrada.target.classList.add("visible");
          observador.unobserve(entrada.target);
        }
      });
    }, { rootMargin: "0px 0px -8% 0px", threshold: 0.08 });
    revelables.forEach(function (el) { observador.observe(el); });
  } else {
    revelables.forEach(function (el) { el.classList.add("visible"); });
  }

  /* ---------- 5. Formulario de contacto ---------------------- */
  var formulario = document.querySelector("[data-formulario]");
  if (!formulario) return;

  var estado = formulario.querySelector("[data-estado]");
  var botonEnviar = formulario.querySelector('button[type="submit"]');
  var textoBoton = botonEnviar.innerHTML;
  var inicio = Date.now();

  // Preselecciona el servicio si se llega desde una ficha (?servicio=slug)
  var slug = new URLSearchParams(location.search).get("servicio");
  if (slug) {
    var opcion = formulario.querySelector('option[data-slug="' + slug.replace(/[^a-z0-9-]/g, "") + '"]');
    if (opcion) opcion.selected = true;
  }

  var mensajes = {
    nombre: "Escribe tu nombre.",
    email: "Escribe un correo válido, por ejemplo nombre@institucion.cl.",
    consulta: "Cuéntanos tu consulta (al menos 10 caracteres)."
  };

  function validarCampo(campo) {
    var error = document.getElementById(campo.getAttribute("aria-describedby"));
    if (!error) return true;
    var valido = campo.checkValidity() && campo.value.trim().length > 0;
    campo.setAttribute("aria-invalid", valido ? "false" : "true");
    error.textContent = valido ? "" : mensajes[campo.name] || "Revisa este campo.";
    return valido;
  }

  var obligatorios = Array.prototype.slice.call(formulario.querySelectorAll("[required]"));
  obligatorios.forEach(function (campo) {
    campo.addEventListener("blur", function () { if (campo.value) validarCampo(campo); });
    campo.addEventListener("input", function () {
      if (campo.getAttribute("aria-invalid") === "true") validarCampo(campo);
    });
  });

  function mostrarEstado(texto, tipo) {
    estado.textContent = texto;
    estado.className = "formulario__estado formulario__estado--" + tipo;
  }

  formulario.addEventListener("submit", function (e) {
    e.preventDefault();
    estado.textContent = "";
    estado.className = "formulario__estado";

    var invalidos = obligatorios.filter(function (c) { return !validarCampo(c); });
    if (invalidos.length) { invalidos[0].focus(); return; }

    // Protección antirrobots: campo trampa lleno o envío en menos de 3 segundos
    var trampa = formulario.querySelector('[name="_honey"]');
    if ((trampa && trampa.value) || Date.now() - inicio < 3000) {
      mostrarEstado("Gracias. Recibimos tu solicitud.", "ok");
      formulario.reset();
      return;
    }

    var datos = {};
    new FormData(formulario).forEach(function (valor, clave) { datos[clave] = valor; });
    var urlAjax = formulario.action.replace("formsubmit.co/", "formsubmit.co/ajax/");

    botonEnviar.disabled = true;
    botonEnviar.setAttribute("aria-busy", "true");
    botonEnviar.textContent = "Enviando…";

    fetch(urlAjax, {
      method: "POST",
      headers: { "Content-Type": "application/json", Accept: "application/json" },
      body: JSON.stringify(datos)
    })
      .then(function (r) { return r.json().then(function (j) { return { ok: r.ok, json: j }; }); })
      .then(function (res) {
        if (!res.ok || String(res.json.success) !== "true") throw new Error(res.json.message || "error");
        formulario.reset();
        mostrarEstado("Gracias, recibimos tu solicitud. Te responderemos a la brevedad.", "ok");
        if (window.dataLayer) window.dataLayer.push({ event: "formulario_enviado" });
      })
      .catch(function () {
        mostrarEstado("No pudimos enviar el formulario. Inténtalo de nuevo o escríbenos a contacto@digitalgmas.cl.", "error");
      })
      .finally(function () {
        botonEnviar.disabled = false;
        botonEnviar.removeAttribute("aria-busy");
        botonEnviar.innerHTML = textoBoton;
      });
  });
})();
