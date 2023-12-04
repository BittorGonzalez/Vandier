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
    //datos[3] = stock

    // Verificar si el producto ya está en el carrito
    const productosEnCarrito = this.divProductosCarrito.querySelectorAll('.productTitle');
    const productoExistente = Array.from(productosEnCarrito).find(producto => producto.textContent === datos[1]);

    if (productoExistente) {
      // Si el producto ya existe, incrementar el valor del input
      const inputExistente = productoExistente.closest('.info').querySelector('.counter');
      inputExistente.value = parseInt(inputExistente.value) + 1;
      this.actualizarPrecioCarrito()

    } else {
      // Si el producto no existe, añadir la nueva card

      const divArticulo = document.createElement("article");
      divArticulo.classList.add(
        "d-flex",
        "gap-2",
        "pb-4",
        "border-bottom",
        "border-2",
        "position-relative",
        "cardstyle"
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
      input.setAttribute("max", datos[3]);

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

      this.actualizarPrecioCarrito()

      divCarrito.classList.replace("d-none", "d-flex");



      // EVENTOS
      btnDecrementa.addEventListener('click', () => {
        if (parseInt(input.value) > 1) {
          input.value = parseInt(input.value) - 1;
          this.actualizarPrecioCarrito()

        }
      });

      btnIncrementa.addEventListener("click", () => {
        if (parseInt(input.value) < parseInt(input.max)) {
          input.value = parseInt(input.value) + 1;
        }

        this.actualizarPrecioCarrito()
      });


      iconBorrar.addEventListener("click", (e) => {
        const elementoPadre = e.target.parentElement;
        this.divProductosCarrito.querySelector(".productosCarrito ").removeChild(elementoPadre);
        this.actualizarPrecioCarrito()

        //Limpiar relacionado con codigos descuento
        const filaDescuento = document.querySelector(".filaDescuento").classList.replace("d-flex", "d-none")
        const mensaje = document.querySelector(".mensajeCarrito").classList.replace("d-block", "d-none")


      });



    }
  }

  // Crear elementos de articulo
  crearCardProducto(datos) {
    const card = document.createElement("div");
    card.classList.add(
      "cardProducto",
      "h-100",
      "w-80",
      "p-4",
      "rounded-5",
      "position-relative",
      "cardstyle"
    );
    
    card.style.backgroundImage =
      "url(N10_Presentacion/N14_Assets/Images/" + datos["imagen"] + ")";
    card.style.backgroundSize = "cover";
    card.style.backgroundPosition = "center center";

    card.setAttribute("data-id", datos["idProducto"]);
    card.setAttribute("data-category", datos["categoria"]);
    card.setAttribute("data-stock", datos["stock"])

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

    //Stock
    let stock = parseInt(contenedor.getAttribute('data-stock'));

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

    datosProducto.push(img, titulo, precio, stock);
    return datosProducto;
  }

  //Guardar info del carrito en localStorage
  guardarCarritoLocalStorage() {


    let carritoInfo = [];

    let carrito = document.querySelector(".productosCarrito")
    let articulos = document.querySelectorAll("article")

    articulos.forEach(articulo => {

      let titulo = articulo.querySelector('.productTitle')
      let precio = articulo.querySelector('.productPrice')
      let cantidad = articulo.querySelector('.counter')
      let imagen = articulo.querySelector('img').getAttribute('src');

      let productoInfo = { 'titulo': titulo.textContent, 'precio': precio.textContent, 'cantidad': cantidad.value, 'imagen': imagen };
      carritoInfo.push(productoInfo);

    })

    if (carritoInfo.length > 0) {
      localStorage.setItem('infoCarrito', JSON.stringify(carritoInfo));
      return true
    } else {
      return false
    }

  }

  actualizarPrecioCarrito(codigo = null, descuento = null) {

    const cantidades = document.querySelectorAll(".counter");
    const precios = document.querySelectorAll(".productPrice");
    const totalTexto = document.querySelector(".precioTotal");
    const subtotalTexto = document.querySelector(".subtotal");
    const precioIVA = document.querySelector(".precio_iva");
    const filaDescuento = document.querySelector(".filaDescuento");
    const tipoDescuento = document.querySelector(".tipoDescuento");
    const descuentoNum = document.querySelector(".descuento");

    let subtotal = 0;
    let totalConIVA = 0;

    cantidades.forEach((cantidad, index) => {
        const cantidadValor = parseInt(cantidad.value);
        const precio = parseFloat(precios[index].innerText.replace("€", ""));
        subtotal += cantidadValor * precio;
    });

    subtotal = subtotal.toFixed(2);
    totalConIVA = (subtotal * (0.21)).toFixed(2);

    subtotalTexto.textContent = subtotal + "€";

    if (codigo && descuento) {
        tipoDescuento.textContent = codigo;
        const descuentoPorcentaje = parseFloat(descuento);
        const descuentoMonto = (subtotal * (descuentoPorcentaje / 100)).toFixed(2);

        descuentoNum.textContent = "- " + descuento + "%";
        filaDescuento.classList.replace("d-none", "d-flex");
        subtotal = (parseFloat(subtotal) - parseFloat(descuentoMonto)).toFixed(2);
    }

    precioIVA.textContent = totalConIVA + "€";
    totalTexto.textContent = (parseFloat(subtotal) + parseFloat(totalConIVA)).toFixed(2) + "€";

  }

  gestionarCodigosDescuento() {


    const mensaje = document.querySelector(".mensajeCarrito")
    mensaje.classList.replace("d-block", "d-none")

    const inputCodigo = document.querySelector(".inputCodigo").value

    if (inputCodigo != "") {

      fetch("../N20_Negocio/N21_Controladores/productosControlador.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },

        // Seleccionar el numero de registros que queremos recibir [0, para recibir todos los productos]
        body: JSON.stringify({
          tipo: "obtenerCodigosDescuento",
          codigo: inputCodigo
        }),

      })
        .then((response) => response.json())
        .then((data) => {
          if (!data["mensaje"]) {

            //Validar si existe en el carrito un producto al que se le puede aplicar el codigo
            let descuentoAplicado = false;
            let productoEnCarritoCoincide = false;

            data.productos.forEach((producto, index) => {
              let productoEnCarrito = document.querySelectorAll(".productosCarrito .productTitle ");
          
              for (let i = 0; i < productoEnCarrito.length; i++) {
                  if (productoEnCarrito[i].textContent === producto) {
                      productoEnCarritoCoincide = true; // Hay al menos un producto en el carrito que coincide
                      if (!descuentoAplicado) {
                          this.actualizarPrecioCarrito(inputCodigo, parseInt(data.descuento));
                          descuentoAplicado = true; // Marcamos que ya hemos aplicado el descuento
                      }
                      break; // Salimos del bucle tan pronto como se encuentra un producto en el carrito
                  }
              }
          });

          if (!descuentoAplicado && !productoEnCarritoCoincide) {
            mensaje.classList.replace("d-none", "d-block");
            mensaje.textContent = "No hay productos asignados a ese código";
        }
        

          } else {
            mensaje.classList.replace("d-none", "d-block")
            mensaje.textContent = "El codigo introducido no existe"
          }
        })
        .catch((error) => console.error("Error:", error));


    } else {
      mensaje.classList.replace("d-none", "d-block")
      mensaje.textContent = "Debes insertar un codigo"
    }


  }
}
