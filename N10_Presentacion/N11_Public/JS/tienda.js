//Crear instancia de la clase carritoManager
const objCarritoManagerInicio = new carritoManager();

fetch("../N20_Negocio/N21_Controladores/productosControlador.php", {
  method: "POST",
  headers: {
    "Content-Type": "application/json",
  },

  // Seleccionar el numero de registros que queremos recibir [0, para recibir todos los productos]
  body: JSON.stringify({ limite: 0 }),
})
  .then((response) => response.json())
  .then((data) => {
    data.forEach((producto) => {
        
    const tarjeta = objCarritoManagerInicio.crearCardProducto(producto);
    pintarCardsContenedor(tarjeta);
    });
  })
  .catch((error) => console.error("Error:", error));

//Pintar cards en el contenedor
function pintarCardsContenedor(card){
    const gridProductos = document.querySelector(".gridProductos");
    const productos = gridProductos.querySelector(".productos")
    productos.appendChild(card);

}
