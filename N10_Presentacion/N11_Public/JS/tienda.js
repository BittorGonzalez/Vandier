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


    filtrarProductosPorCategoria();


}


//Filtrar cards
function filtrarProductosPorCategoria() {
  const btnFiltros = document.querySelectorAll(".btnCategoria");
  const cards = document.querySelectorAll(".cardProducto");

  btnFiltros.forEach(btn => {
    btn.addEventListener("click", (e) => {
      const categoriaSeleccionada = e.target.textContent.toLowerCase();

      cards.forEach(card => {
        const categoriaCard = card.getAttribute("data-category").toLowerCase();

        if (categoriaCard === categoriaSeleccionada || categoriaSeleccionada === "todos") {
          let col = card.closest('.colContenedor'); // Reemplaza con el selector correcto de tu contenedor de columna
          if (col) {
            col.style.display = "flex"; // Mostrar la card
          }
        } else {
          let col = card.closest('.colContenedor'); // Reemplaza con el selector correcto de tu contenedor de columna
          if (col) {
            col.style.display = "none"; // Ocultar la card
          }
        }
      });
    });
  });
}




