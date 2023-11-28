class carritoManager {
  //Se encuentra el elemento del carrito
  constructor() {
    this.divProductosCarrito = document.querySelector(".productosCarrito");
  }
  //Metodo para crear articulo y añadirlo al elemento carrito
  añadirProductoAlCarrito(idProducto) {

    fetch("../N20_Negocio/N21_Controladores/productosControlador.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
    
      // Seleccionar el numero de registros que queremos recibir [0, para recibir todos los productos]
      body: JSON.stringify({ id: idProducto }),
    })
      .then((response) => response.json())
      .then((data) => {
        console.log(data)
      })
      .catch((error) => console.error("Error:", error));

    const divProductosCarrito = document.querySelector(".productosCarrito");

    const divArticulo = document.createElement("article");
    divArticulo.classList.add(
      "d-flex",
      "gap-2",
      "pb-4",
      "border-bottom",
      "border-2",
      "position-relative"
    );

    const iconBorrar = document.createElement("i");
    iconBorrar.classList.add(
      "borrarProducto",
      "fa-regular",
      "fa-circle-xmark",
      "text-danger"
    );

    const imgProducto = document.createElement("img");
    imgProducto.classList.add("rounded");
    imgProducto.setAttribute("src", imagenSrc);

    const infoProducto = document.createElement("div");
    infoProducto.classList.add("info", "d-flex", "flex-column");

    const tituloProducto = document.createElement("h2");
    tituloProducto.classList.add("productTitle", "fw-bold");
    tituloProducto.textContent = nombreProducto;

    const divCantidadPrecio = document.createElement("div");
    divCantidadPrecio.classList.add(
      "cantidad_precio",
      "mt-1",
      "w-100",
      "d-flex",
      "justify-content-between",
      "align-items-center"
    );

    const contador = document.createElement("div");
    contador.classList.add("contador", "d-flex", "align-items-center", "gap-1");

    const btnDecrementa = document.createElement("button");
    btnDecrementa.classList.add("btnDecrementa", "bg-white", "border-0");
    btnDecrementa.textContent = "-";

    const input = document.createElement("input");
    input.setAttribute("type", "number");
    input.setAttribute("value", "1");
    input.classList.add("counter", "border-0");

    const btnIncrementa = document.createElement("button");
    btnIncrementa.classList.add("btnIncrementa", "bg-white", "border-0");
    btnIncrementa.textContent = "+";

    contador.appendChild(btnDecrementa);
    contador.appendChild(input);
    contador.appendChild(btnIncrementa);

    const precioProductoElement = document.createElement("span");
    precioProductoElement.classList.add("fw-bold");
    precioProductoElement.textContent = precioProducto;

    divCantidadPrecio.appendChild(contador);
    divCantidadPrecio.appendChild(precioProductoElement);

    infoProducto.appendChild(tituloProducto);
    infoProducto.appendChild(divCantidadPrecio);

    divArticulo.appendChild(iconBorrar);
    divArticulo.appendChild(imgProducto);
    divArticulo.appendChild(infoProducto);

    divProductosCarrito.appendChild(divArticulo);
  }

  //Metodo para controlar los eventos de los botones
  controlarBotonesArticulos(divProductosCarrito) {
    const btn_incrementar =
      divProductosCarrito.querySelectorAll(".btnIncrementa");
    const value_input = divProductosCarrito.querySelectorAll(".counter");
    const btn_decrementar =
      divProductosCarrito.querySelectorAll(".btnDecrementa");
    const btn_borrar = divProductosCarrito.querySelectorAll(".borrarProducto");

    btn_incrementar.forEach((btn, index) => {
      btn.addEventListener("click", (e) => {
        e.stopImmediatePropagation();
        value_input[index].value = parseInt(value_input[index].value) + 1;
      });
    });

    btn_decrementar.forEach((btn, index) => {
      btn.addEventListener("click", (e) => {
        e.stopImmediatePropagation();

        if (parseInt(value_input[index].value) > 1) {
          value_input[index].value = parseInt(value_input[index].value) - 1;
        }
      });
    });
  }

  //Crear elementos de articulo
  crearCardProducto(datos) {
    const card = document.createElement("div");
    card.classList.add(
      "cardProducto",
      "h-100",
      "w-100",
      "p-2",
      "rounded-3",
      "position-relative"
    );

    card.style.backgroundImage =
      "url(N10_Presentacion/N14_Assets/Images/" + datos['imagen'] + ")";
    card.style.backgroundSize = "cover";
    card.style.backgroundPosition = "center center";


    card.setAttribute("data-id", datos["id"]);
    card.setAttribute('data-category', ["categoria"])

    const contenido = document.createElement("div");
    contenido.classList.add(
      "contenido",
      "z-1",
      "position-absolute",
      "p-3",
      "d-flex",
      "flex-column",
      "justify-content-end",
      "w-100",
      "h-100",
      "pb-5"
    );

    const productInfo = document.createElement("div");
    productInfo.classList.add("productInfo", "d-flex", "flex-column");

    const titulo = document.createElement("h2");
    titulo.classList.add("fw-bold");
    titulo.textContent = datos["nombre"];

    const precio = document.createElement("span");
    precio.classList.add("fs-4");
    precio.textContent = datos[precio];

    productInfo.appendChild(titulo);
    productInfo.appendChild(precio);

    const productbtns = document.createElement("div");
    productbtns.classList.add(
      "productBtns",
      "d-flex",
      "gap-3",
      "mt-3",
      "align-items-center"
    );

    const btnCarrito = document.createElement("button");
    btnCarrito.setAttribute("type", "button");
    btnCarrito.classList.add(
      "btnCarrito",
      "btn",
      "d-flex",
      "justify-content-center",
      "align-items-center",
      "fs-5",
      "fw-bold",
      "rounded-3",
      "border-0"
    );
    btnCarrito.textContent = "+";

    btnCarrito.addEventListener("click", (e) => {

      

      let idProducto = e.target.parentNode.parentNode.parentNode.getAttribute('data-id')
      this.añadirProductoAlCarrito(idProducto)

    });

    const btnFav = document.createElement("button");
    btnFav.setAttribute("type", "button");
    btnFav.classList.add(
      "btnFav",
      "btn",
      "d-flex",
      "justify-content-center",
      "align-items-center"
    );
    btnFav.innerHTML = '<i class="fa-solid fa-heart text-danger fs-3"></i>';

    productbtns.appendChild(btnCarrito);
    productbtns.appendChild(btnFav);

    contenido.appendChild(productInfo);
    contenido.appendChild(productbtns);

    card.appendChild(contenido);

    const col = document.createElement('div')
    col.classList.add('col')
    col.appendChild(card)

    return col;
  }

  //Calcular el numero de articulos que existen en el carrito y retornar
  mostrarNumProductosCarrito() {
    const divProductosCarrito = document.querySelector(".productosCarrito");
    
    let articulos = divProductosCarrito.querySelectorAll('article')
    let numArticulos = articulos.length

    return numArticulos;
  }

  //Obtener info articulo clickado
  obtenerinfoProducto(e){
    console.log(idProducto)
  }

}



