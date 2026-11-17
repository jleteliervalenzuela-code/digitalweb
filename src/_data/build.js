// Versión de la compilación: se agrega a las URL de CSS y JS para que
// los navegadores descarguen la versión nueva después de cada publicación.
export default {
  version: Date.now().toString(36),
  fecha: new Date(),
};
