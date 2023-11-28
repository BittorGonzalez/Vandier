//Crear instancia de la clase carritoManager
const objCarritoManagerInicio = new carritoManager();

fetch("../N20_Negocio/N21_Controladores/productosControlador.php", {
  method: "GET",
  headers: {
    "Content-Type": "application/json",
  },
})
  .then((response) => response.json())
  .then((data) => {
    if (data.length >= 4) {
      // Genera un índice aleatorio para cada elemento
      const indicesAleatorios = [];
      while (indicesAleatorios.length < 4) {
        const indice = Math.floor(Math.random() * data.length);
        if (!indicesAleatorios.includes(indice)) {
          indicesAleatorios.push(indice);
        }
      }

      // Filtra solo las cuatro posiciones aleatorias
      const resultadosAleatorios = indicesAleatorios.map(
        (indice) => data[indice]
      );

      resultadosAleatorios.forEach((producto) => {

        const tarjeta = objCarritoManagerInicio.crearCardProducto(producto);
        pintarCardsContenedor(tarjeta)

      });
    } else {
      console.error("El array no tiene al menos cuatro elementos.");
    }
  })
  .catch((error) => console.error("Error:", error));


//Pintar cards en el contenedor
function pintarCardsContenedor(card){
    const container = document.querySelector(".containerProductos");

    container.appendChild(card);

}