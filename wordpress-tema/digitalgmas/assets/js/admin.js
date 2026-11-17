/* Selector de imágenes de los campos «Galería», «Franja» e «Imagen de la línea». */
(function ($) {
  "use strict";
  $(document).on("click", ".dgm-imagenes .dgm-elegir", function (e) {
    e.preventDefault();
    var caja = $(this).closest(".dgm-imagenes");
    var multiple = caja.data("multiple") === 1 || caja.data("multiple") === "1";
    var campo = caja.find("input[type=hidden]");
    var marco = wp.media({
      title: multiple ? "Elegir fotos" : "Elegir imagen",
      button: { text: "Usar" },
      library: { type: "image" },
      multiple: multiple ? "add" : false
    });
    marco.on("open", function () {
      var seleccion = marco.state().get("selection");
      (campo.val() || "").split(",").filter(Boolean).forEach(function (id) {
        var adjunto = wp.media.attachment(id);
        adjunto.fetch();
        seleccion.add(adjunto);
      });
    });
    marco.on("select", function () {
      var elegidos = marco.state().get("selection").toJSON();
      campo.val(elegidos.map(function (a) { return a.id; }).join(","));
      var mini = caja.find(".dgm-miniaturas").empty();
      elegidos.forEach(function (a) {
        var url = (a.sizes && a.sizes.thumbnail ? a.sizes.thumbnail.url : a.url);
        mini.append($("<img>", { src: url, alt: "", css: { width: 72, height: 72, objectFit: "cover", borderRadius: 4 } }));
      });
    });
    marco.open();
  });
  $(document).on("click", ".dgm-imagenes .dgm-quitar", function (e) {
    e.preventDefault();
    var caja = $(this).closest(".dgm-imagenes");
    caja.find("input[type=hidden]").val("");
    caja.find(".dgm-miniaturas").empty();
  });
})(jQuery);
