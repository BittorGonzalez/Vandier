// FUNCIONALIDAD DEL HEADER

// LOGIN
const iconoLogin = document.querySelector(".iconoUsuario");
const divLogin = document.querySelector(".login_content");
const contenedorLogin = iconoLogin.closest('li');
const btnLogin = document.querySelector(".btn_iniciarsesion")
const btnRegistro = document.querySelector(".btn_registro")

contenedorLogin.addEventListener("mouseover", () => {
    divLogin.classList.replace("d-none", "d-block");
});

contenedorLogin.addEventListener("mouseout", () => {
    divLogin.classList.replace("d-block", "d-none");
});


btnLogin.addEventListener("click", ()=>{
    alert("INICIAR SESION")
})


//FUNCIONALIDAD CARRITO
const iconoCarrito = document.querySelector(".iconoCarrito")
const divCarrito = document.querySelector(".carrito_content")
const contenerCarrito = iconoCarrito.closest('li')
const btnIncrementa = document.querySelector(".btnIncrementa")
const btnDecrementa = document.querySelector(".btnDecrementa")
const contador = document.querySelector(".counter")

contenerCarrito.addEventListener("mouseover", () => {
    divCarrito.classList.replace("d-none", "d-flex");
});

contenerCarrito.addEventListener("mouseout", () => {
    divCarrito.classList.replace("d-flex", "d-none");
});

btnIncrementa.addEventListener("click", () => {
    contador.value = ++contador.textContent;
});

btnDecrementa.addEventListener("click", () => {

    if(parseInt(contador.textContent) >1){
        contador.value = --contador.textContent;
    }
});

