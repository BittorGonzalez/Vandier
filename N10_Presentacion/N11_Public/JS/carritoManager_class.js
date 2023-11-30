class carritoManager {
  // Se encuentra el elemento del carrito
  constructor() {
    this.divProductosCarrito = document.querySelector(".carrito_content");
  }

  // Método para crear articulo y añadirlo al elemento carrito
  añadirProductoAlCarrito(datos) {

    //datos[0] = img
    //datos[1] = titulo
    //datos[2] = precio
    //datos[3] = cantidad

    // Verificar si el producto ya está en el carrito
    const productosEnCarrito = this.divProductosCarrito.querySelectorAll('.productTitle');
    const productoExistente = Array.from(productosEnCarrito).find(producto => producto.textContent === datos[1]);

    if (productoExistente) {
      // Si el producto ya existe, incrementar el valor del input
      const inputExistente = productoExistente.closest('.info').querySelector('.counter');
      inputExistente.value = parseInt(inputExistente.value) + 1;
    } else {
      // Si el producto no existe, añadir la nueva card
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
      imgProducto.setAttribute("src", datos[0]);

      const infoProducto = document.createElement("div");
      infoProducto.classList.add("info", "d-flex", "flex-column");

      const tituloProducto = document.createElement("h2");
      tituloProducto.classList.add("productTitle", "fw-bold");
      tituloProducto.textContent = datos[1];

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
      input.setAttribute("value", 1);
      input.classList.add("counter", "border-0");

      const btnIncrementa = document.createElement("button");
      btnIncrementa.classList.add("btnIncrementa", "bg-white", "border-0");
      btnIncrementa.textContent = "+";

      contador.appendChild(btnDecrementa);
      contador.appendChild(input);
      contador.appendChild(btnIncrementa);

      const precioProductoElement = document.createElement("span");
      precioProductoElement.classList.add("fw-bold", 'productPrice');
      precioProductoElement.textContent = datos[2] + "€";

      divCantidadPrecio.appendChild(contador);
      divCantidadPrecio.appendChild(precioProductoElement);

      infoProducto.appendChild(tituloProducto);
      infoProducto.appendChild(divCantidadPrecio);

      divArticulo.appendChild(iconBorrar);
      divArticulo.appendChild(imgProducto);
      divArticulo.appendChild(infoProducto);

      this.divProductosCarrito.querySelector('.productosCarrito ').appendChild(divArticulo)

      divCarrito.classList.replace("d-none", "d-flex");

  

      // EVENTOS
      btnDecrementa.addEventListener('click', () => {
        if (parseInt(input.value) > 1) {
          input.value = parseInt(input.value) - 1;
        }
      });

      btnIncrementa.addEventListener("click", () => {
        input.value = parseInt(input.value) + 1;
      });


      iconBorrar.addEventListener("click", (e) => {
        const elementoPadre = e.target.parentElement;
        this.divProductosCarrito.querySelector(".productosCarrito ").removeChild(elementoPadre);
        this.comprobarNoProductos()
      });



    }
  }

  // Crear elementos de articulo
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
      "url(N10_Presentacion/N14_Assets/Images/" + datos["imagen"] + ")";
    card.style.backgroundSize = "cover";
    card.style.backgroundPosition = "center center";

    card.setAttribute("data-id", datos["idProducto"]);
    card.setAttribute("data-category", datos["categoria"]);

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
    precio.textContent = datos['precio'] + "€";

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
      let idProducto = e.target.parentNode.parentNode.parentNode.getAttribute("data-id");
      this.añadirProductoAlCarrito(this.obtenerDatosProductoPorId(idProducto));
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

    const col = document.createElement("div");
    col.classList.add("col", "colContenedor");
    col.appendChild(card);

    return col;
  }

  //Obtener los datos del producto seleccionado
  obtenerDatosProductoPorId(idProducto) {
    let datosProducto = [];
    const contenedor = document.querySelector('.cardProducto[data-id="' + idProducto + '"]');

    // Imagen
    let imgURL = contenedor.getAttribute('style');
    const coincidencia = imgURL.match(/url\("([^"]+)"\)/);
    const img = coincidencia[1];

    // Titulo
    let h2 = contenedor.querySelector('.productInfo h2');
    const titulo = h2.textContent;

    // Precio
    let span = contenedor.querySelector('.productInfo span');
    const precio = parseFloat(span.textContent).toFixed(2);;

    datosProducto.push(img, titulo, precio);
    return datosProducto;
  }

  //Guardar info del carrito en localStorage
  guardarCarritoLocalStorage(){

    
      let carritoInfo = [];

      let carrito = document.querySelector(".productosCarrito")
      let articulos = document.querySelectorAll("article")

      articulos.forEach(articulo =>{

          let titulo = articulo.querySelector('.productTitle')
          let precio = articulo.querySelector('.productPrice')
          let cantidad = articulo.querySelector('.counter')
          let imagen = articulo.querySelector('img').getAttribute('src');

          let productoInfo = {'titulo' : titulo.textContent, 'precio': precio.textContent, 'cantidad' : cantidad.value, 'imagen' :imagen};
          carritoInfo.push(productoInfo);

        })

        if(carritoInfo.length > 0){
          localStorage.setItem('infoCarrito', JSON.stringify(carritoInfo));
          return true
        }else{
          return false
        }

    }

}
