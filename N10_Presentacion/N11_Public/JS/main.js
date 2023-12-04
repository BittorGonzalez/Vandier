// FUNCIONALIDAD DEL HEADER

//Crear instancia de la clase carritoManager
const objCarritoManagerMain = new carritoManager();

//Al cargar la pagina obtener informacion del logueo y informacion del carrito
window.onload = cargarEstadoLogin();
//window.onload = objCarritoManagerMain.insertarProductosLocalStorageEnCarrito()


//Controlar que un usuario normal entre en administracion
const userInfo = JSON.parse(localStorage.getItem('userInfo'));
const url = window.location.pathname;
const parteDespuesDelDominio = url.split('/').filter(Boolean).pop();

if (userInfo && userInfo.idRol === 1 && (parteDespuesDelDominio === 'productos' || parteDespuesDelDominio === 'pedidos' || parteDespuesDelDominio === 'usuarios' || parteDespuesDelDominio === 'descuentos') ) {
  location.href = "/";
} 



// ---------------------LOGIN-----------------------------------

//Elmentos del DOM
const iconoLogin = document.querySelector(".iconoUsuario");
const divLogin = document.querySelector(".login_content");
const contenedorLogin = iconoLogin.closest("li");
const btnLogin = document.querySelector(".btn_iniciarsesion");
const btnRegistro = document.querySelector(".btn_registro");
const inputUsuario = document.querySelector(".inputUsuario");
const inputContraseña = document.querySelector(".inputContraseña");
const loginInfo = document.querySelector(".loginInfo");
const btnCerrarSesion = document.querySelector(".btn_cerrarSesion");

//Gestion de eventos
contenedorLogin.addEventListener("mouseover", () => {
  divLogin.classList.replace("d-none", "d-block");
});

contenedorLogin.addEventListener("mouseout", () => {
  divLogin.classList.replace("d-block", "d-none");
});

if (btnLogin) {
  btnLogin.addEventListener("click", () => {
    let datosLogin = obtenerDatosLogin();

    if (datosLogin) {
      fetch("../N20_Negocio/N21_Controladores/usuariosControlador.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          tipo: "validarLogin",
          datos: {
            usuario: datosLogin[0],
            email: datosLogin[1],
            contrasena: datosLogin[2]
          }
        }),
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.mensaje != undefined) {
            loginInfo.textContent = "Usuario o contraseña incorrectos";
            loginInfo.classList.replace("d-none", "d-block");
          } else {
            alert(data[0].usuario + " te has logueado correctamente");

            if(data[0].idRol === 2){
              location.href = "productos";

            }else{
              location.href = "/";
            }
            localStorage.setItem("userInfo", JSON.stringify(data[0]));
            cargarEstadoLogin();
          }
        })
        .catch((error) => console.error("Error:", error));
    }
  });
}

//Obtener datos del formulario
function obtenerDatosLogin() {
  loginInfo.classList.replace("d-block", "d-none");

  let resul = [];
  let usuario = inputUsuario.value.trim();
  let contraseña = inputContraseña.value.trim();
  let email;

  if (usuario === "" || contraseña === "") {
    loginInfo.textContent = "Debes llenar los campos";
    loginInfo.classList.replace("d-none", "d-block");
  } else {
    if (usuario.includes("@")) {
      email = usuario;
    }
    resul.push(usuario, email, contraseña);
  }

  //Ternaria: Si el array tiene registros se manda sino se manda un null
  return resul.length > 0 ? resul : null;
}

// ---------------------LOGIN-----------------------------------

//--------------------------- CARRITO-------------------------------
//Elementos del DOM
const iconoCarrito = document.querySelector(".iconoCarrito");
const contadorCarrito = document.querySelector(".contadorCarrito");
const divCarrito = document.querySelector(".carrito_content");
const contenerCarrito = iconoCarrito.closest("li");
const btnIncrementa = document.querySelector(".btnIncrementa");
const btnDecrementa = document.querySelector(".btnDecrementa");
const btnIniciarSesionCarrito = document.querySelector(
  ".btn_iniciarSesionCarrito"
);

//Gestion del DOM
contenerCarrito.addEventListener("mouseover", () => {
  divCarrito.classList.replace("d-none", "d-flex");
});

contenerCarrito.addEventListener("mouseout", () => {
  divCarrito.classList.replace("d-flex", "d-none");
});

btnIniciarSesionCarrito.addEventListener("click", () => {
  divLogin.classList.replace("d-none", "d-block");
  divCarrito.classList.replace("d-flex", "d-none");
});

//--------------------------- CARRITO-------------------------------

//Obtener informacion de logueo
function cargarEstadoLogin() {
  fetch("../N20_Negocio/N21_Controladores/usuariosControlador.php?accion2=obtenerEstadoLogin", {
    method: "GET",
    headers: {
      "Content-Type": "application/json",
    },
  })
    .then((response) => response.json())
    .then((data) => {
      cargarFormularioDinamico(data.usuarioLogueado);
    })
    .catch((error) => console.error("Error:", error));
}

//Si el usuario se ha logueado cambiar el contenido del formulario
function cargarFormularioDinamico(usuarioLogueado) {

  const datosUsuario = JSON.parse(localStorage.getItem("userInfo"));

  if (usuarioLogueado) {
    cargarFormularioPerfil(datosUsuario);
    cargarFormularioCarrito();
    contadorCarrito.classList.remove("d-none");
  } else {
    //Reajustar estilos del contenedor
    divCarrito.style.width = "17em";
    divCarrito.classList.add("p-3");
    contadorCarrito.classList.add("d-none");
  }
}

//Funcion que se encarga de crear los elementos del perfil
function cargarFormularioPerfil(datosUsuario) {
  //Perfil
  divLogin.innerHTML = "";

  const divInfoUsuario = document.createElement("div");
  divInfoUsuario.classList.add(
    "infoUsuario",
    "d-flex",
    "align-items-center",
    "gap-3"
  );

  const userIcon = document.createElement("div");
  userIcon.classList.add(
    "userIcon",
    "d-flex",
    "justify-content-center",
    "align-items-center"
  );

  const icono = document.createElement("i");
  icono.classList.add(
    "fa-solid",
    "fa-user",
    "p-3",
    "border",
    "border-2",
    "border-dark",
    "rounded-circle",
    "fs-4"
  );

  userIcon.appendChild(icono);

  const userInfo = document.createElement("div");
  userInfo.classList.add("userInfo", "d-flex", "flex-column");

  const userNombre = document.createElement("span");
  userNombre.classList.add("fw-bold", "fs-5");
  userNombre.textContent =
    datosUsuario["nombre"] + " " + datosUsuario["apellido"];

  const userUsuario = document.createElement("span");
  userUsuario.textContent = "@" + datosUsuario["usuario"];

  userInfo.appendChild(userNombre);
  userInfo.appendChild(userUsuario);

  divInfoUsuario.appendChild(userIcon);
  divInfoUsuario.appendChild(userInfo);

  const divOpcionesPerfil = document.createElement("div");
  divOpcionesPerfil.classList.add("opcionesPerfil", "mt-3");

  const listaOpciones = document.createElement("ul");
  listaOpciones.classList.add("d-flex", "flex-column", "gap-2");

  const itemOpcion1 = document.createElement("li");
  itemOpcion1.classList.add("border-bottom", "pb-2");

  const itemLink1 = document.createElement("a");
  itemLink1.setAttribute("href", "/perfil");
  itemLink1.classList.add("fw-bold");
  itemLink1.textContent = "Perfil";

  itemOpcion1.appendChild(itemLink1);

  const itemOpcion2 = document.createElement("li");
  itemOpcion2.classList.add("border-bottom", "pb-2");

  const itemLink2 = document.createElement("a");
  itemLink2.setAttribute("href", "");
  itemLink2.classList.add("fw-bold");
  itemLink2.textContent = "Pedidos";

  itemOpcion2.appendChild(itemLink2);

  const itemOpcion3 = document.createElement("li");

  const btn = document.createElement("button");
  btn.setAttribute("type", "button");
  btn.classList.add(
    "btn_cerrarSesion",
    "btn",
    "btn-dark",
    "text-white",
    "fw-bold",
    "mt-3"
  );
  btn.textContent = "Cerrar sesion";

  itemOpcion3.appendChild(btn);

  listaOpciones.appendChild(itemOpcion1);
  listaOpciones.appendChild(itemOpcion2);
  listaOpciones.appendChild(itemOpcion3);

  divOpcionesPerfil.appendChild(listaOpciones);

  divLogin.appendChild(divInfoUsuario);
  divLogin.appendChild(divOpcionesPerfil);

  btn.addEventListener("click", () => {
    fetch("../N20_Negocio/N21_Controladores/usuariosControlador.php?accion=eliminarSesion", {
      method: "DELETE",
      headers: {
        "Content-Type": "application/json",
      },
    }).catch((error) => console.error("Error:", error));

    cargarEstadoLogin();
    alert("Has cerrado la sesion");

    //Tengo que recargar la pagina para que se me aplique el cambio y se cambie el formulario
    window.location.reload();
  });
}

//Funcion que se encarga de crear los elementos del carrito
function cargarFormularioCarrito() {
  //Carrito

  divCarrito.innerHTML = "";

  divCarrito.style.width = "21em";
  divCarrito.classList.remove("p-3");

  const divProductosCarrito = document.createElement("div");
  divProductosCarrito.classList.add("productosCarrito", "p-3");

  // Crear el contenedor principal
  const resumenDiv = document.createElement("div");
  resumenDiv.classList.add(
    "resumen",
    "d-flex",
    "flex-column",
    "mt-3",
    "p-3",
    "w-100"
  );

  // Crear el bloque de códigos descuento
  const codigosDescuentoDiv = document.createElement("div");
  codigosDescuentoDiv.classList.add("codigos_descuento", "position-relative");

  const codigosDescuentoLabel = document.createElement("span");
  codigosDescuentoLabel.classList.add("fw-bold");
  codigosDescuentoLabel.textContent = "Tienes códigos descuento?";

  const codigoDescuentoInput = document.createElement("input");
  codigoDescuentoInput.type = "text";
  codigoDescuentoInput.classList.add(
    "form-control",
    "px-3",
    "py-2",
    "border-dark",
    "mt-2",
    "inputCodigo",
    "text-uppercase"
  );
  codigoDescuentoInput.placeholder = "Código";

  const aplicarCodigoButton = document.createElement("button");
  aplicarCodigoButton.type = "button";
  aplicarCodigoButton.classList.add(
    "btn",
    "btn-dark",
    "d-flex",
    "justify-content-center",
    "align-items-center"
  );
  aplicarCodigoButton.innerHTML = '<i class="fa-solid fa-check"></i>';

  const mensaje = document.createElement('p')
  mensaje.classList.add("mensajeCarrito", "text-danger", "fw-bold", "mt-2", "d-none")
  mensaje.textContent = "oiug"


  aplicarCodigoButton.addEventListener("click", () => {
    objCarritoManagerMain.gestionarCodigosDescuento();
  })

  // Agregar elementos al bloque de códigos descuento
  codigosDescuentoDiv.appendChild(codigosDescuentoLabel);
  codigosDescuentoDiv.appendChild(codigoDescuentoInput);
  codigosDescuentoDiv.appendChild(mensaje);
  codigosDescuentoDiv.appendChild(aplicarCodigoButton);

  // Agregar el bloque de códigos descuento al contenedor principal
  resumenDiv.appendChild(codigosDescuentoDiv);

  // Crear las filas de información
  const fila1 = document.createElement("div");
  fila1.classList.add("row", "d-flex", "justify-content-between", "mt-4");

  const subtotal = document.createElement("span");
  subtotal.classList.add("col");
  subtotal.textContent = "Subtotal:";

  const subtotalCantidad = document.createElement("span");
  subtotalCantidad.classList.add("col", "text-end", "subtotal");
  subtotalCantidad.textContent = "165€";

  fila1.appendChild(subtotal);
  fila1.appendChild(subtotalCantidad);

  const filaDescuento = document.createElement("div");
  filaDescuento.classList.add("row", "d-none", "justify-content-between", "mt-2", "filaDescuento")

  const tipoDescuento = document.createElement("span")
  tipoDescuento.classList.add("col", "tipoDescuento", "text-uppercase")
  tipoDescuento.textContent = ""

  const descuentoNum = document.createElement("span")
  descuentoNum.classList.add("col", "text-end", "descuento")
  descuentoNum.textContent = 0

  filaDescuento.appendChild(tipoDescuento)
  filaDescuento.appendChild(descuentoNum)

  const fila2 = document.createElement("div");
  fila2.classList.add("row", "d-flex", "justify-content-between", "mt-2");

  const IVA = document.createElement("span");
  IVA.classList.add("col");
  IVA.textContent = "21% IVA:";

  const precioIVA = document.createElement("span");
  precioIVA.classList.add("col", "text-end", "precio_iva");
  precioIVA.textContent = "185€";

  fila2.appendChild(IVA);
  fila2.appendChild(precioIVA);

  const fila3 = document.createElement("div");
  fila3.classList.add("row", "d-flex", "justify-content-between", "mt-4");

  const total = document.createElement("h2");
  total.classList.add("col", "fw-bold", "total");
  total.textContent = "TOTAL:";

  const totalCantidad = document.createElement("h2");
  totalCantidad.classList.add("col", "fw-bold", "text-end", "precioTotal");
  totalCantidad.textContent = "185€";

  fila3.appendChild(total);
  fila3.appendChild(totalCantidad);

  const btnComprar = document.createElement("button");
  btnComprar.setAttribute("type", "button");
  btnComprar.classList.add("btn", "btn-dark", "mt-2");
  btnComprar.textContent = "COMPRAR";

  btnComprar.addEventListener("click", () => {
    let infoCarrito = objCarritoManagerMain.guardarCarritoLocalStorage();

    if (infoCarrito) {
      mandarDatosDeCompra();
    }


  });

  const lineaDivisora = document.createElement("hr");
  const lineaDivisora2 = document.createElement("hr");
  const lineaDivisora3 = document.createElement("hr");

  filaDescuento.appendChild(lineaDivisora3)

  resumenDiv.appendChild(fila1);
  resumenDiv.appendChild(lineaDivisora);
  resumenDiv.appendChild(filaDescuento)
  resumenDiv.appendChild(fila2);
  resumenDiv.appendChild(lineaDivisora2);
  resumenDiv.appendChild(fila3);
  resumenDiv.appendChild(btnComprar);

  divCarrito.appendChild(divProductosCarrito);
  divCarrito.appendChild(resumenDiv);
}


function mandarDatosDeCompra() {
  let userInfoString = localStorage.getItem("userInfo");
  let idUsuario;

  if (userInfoString) {
    const userInfo = JSON.parse(userInfoString);
    idUsuario = userInfo.id;
  }

  let infoCarritoString = localStorage.getItem("infoCarrito");
  let ventaLineas;

  if (infoCarritoString) {
    ventaLineas = JSON.parse(infoCarritoString);
  }

  if (idUsuario !== undefined && ventaLineas !== undefined) {
    const params = {
      idUsuario: idUsuario,
      ventaLineas: ventaLineas
    };


    fetch("../N20_Negocio/N21_Controladores/ventasControlador.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(params)
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.estado === 'success') {
          alert("Compra realizada con exito")
        } else {
          alert("No se ha podido realizar la compra")

        }
      })
      .catch((error) => console.error("Error:", error));
  } else {
    console.log("No se pudieron obtener los valores necesarios desde el localStorage.");
  }
}



//------------------------------DASHBOARD-----------------------------


//TOPBAR
const admin = document.querySelector(".topbar")

if (admin) {

  const textoUsuario = document.querySelector(".perfilUsuario")
  textoUsuario.textContent = JSON.parse(localStorage.getItem('userInfo')).usuario

}