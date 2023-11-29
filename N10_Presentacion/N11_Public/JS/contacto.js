var botonEnviar = document.querySelector(".btn.btn-primary");

// Agregar un event listener al botón
botonEnviar.addEventListener("click", function(event) {
    event.preventDefault();

    var nombreInput = document.getElementById("exampleFormControlInput1");
    var emailInput = document.getElementById("exampleFormControlInput2");
    var mensajeTextarea = document.getElementById("exampleFormControlTextarea1");

    var nombre = nombreInput.value;
    var email = emailInput.value;
    var mensaje = mensajeTextarea.value;

    if (nombre !== "" && email !== "" && mensaje !== "") {
        alert("MENSAJE ENVIADO");
    } else {
        alert("¡No todos los campos están llenos!");
    }
});
