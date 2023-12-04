const inputUsuarioPerfil = document.querySelector("#inputUsername");
const inputNombrePerfil = document.querySelector("#inputFirstName");
const inputApellidoPerfil = document.querySelector("#inputLastName");
const inputCorreoPerfil = document.querySelector("#inputOrgName");
const inputContraseñaPerfil = document.querySelector("#inputLocation");

const btnGuardar = document.querySelector(".btnGuardar");

let datosUsuario = JSON.parse(localStorage.getItem("userInfo"));

inputUsuarioPerfil.value = datosUsuario.usuario;
inputNombrePerfil.value = datosUsuario.nombre;
inputApellidoPerfil.value = datosUsuario.apellido;
inputCorreoPerfil.value = datosUsuario.email;
inputContraseñaPerfil.value = datosUsuario.passw;

// Expresión regular para validar el formato del correo electrónico
const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

// Función para validar el formulario
function validarFormulario() {
  let newInputUsuarioPerfil = inputUsuarioPerfil.value;
  let newInputNombrePerfil = inputNombrePerfil.value;
  let newInputApellidoPerfil = inputApellidoPerfil.value;
  let newInputCorreoPerfil = inputCorreoPerfil.value;
  let newInputContraseñaPerfil = inputContraseñaPerfil.value;

  // Validar que ningún campo esté vacío
  if (
    newInputUsuarioPerfil.trim() === "" ||
    newInputNombrePerfil.trim() === "" ||
    newInputApellidoPerfil.trim() === "" ||
    newInputCorreoPerfil.trim() === "" ||
    newInputContraseñaPerfil.trim() === ""
  ) {
    alert("Todos los campos son obligatorios. Por favor, completa todos los campos.");
    return Promise.resolve(false);
  }

  // Validar el correo electrónico con la expresión regular
  if (!emailRegex.test(newInputCorreoPerfil)) {
    alert("Por favor, introduce una dirección de correo electrónico válida.");
    return Promise.resolve(false);
  }

  // Validar que no se cambie el usuario ni correo electrónico a uno ya existente
  return fetch("../N20_Negocio/N21_Controladores/usuariosControlador.php?accion2=comprobarUsuariosExistente", {
    method: "GET",
    headers: {
      "Content-Type": "application/json",
    },
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error(`Error de red: ${response.status}`);
      }
      return response.json();
    })
    .then((data) => {

      // Verificar si hay cambios en los datos
      if (
        (newInputUsuarioPerfil !== datosUsuario.usuario && data.some(item => item.usuario === newInputUsuarioPerfil)) ||
        (newInputCorreoPerfil !== datosUsuario.email && data.some(item => item.email === newInputCorreoPerfil))
      ) {
        alert("El usuario o el correo electrónico ya existe. Por favor, elige otro.");
        return false;
      }

      // Si todo está bien, puedes devolver true o realizar más validaciones según sea necesario
      return true;
    })
    .catch((error) => {
      console.error("Error:", error);
      return false;
    });
}


btnGuardar.addEventListener("click", () => {
  validarFormulario().then((formularioValido) => {
    if (formularioValido) {
      // Obtener nuevos valores introducidos
      let newInputUsuarioPerfil = inputUsuarioPerfil.value.trim();
      let newInputNombrePerfil = inputNombrePerfil.value.trim();
      let newInputApellidoPerfil = inputApellidoPerfil.value.trim();
      let newInputCorreoPerfil = inputCorreoPerfil.value.trim();
      let newInputContraseñaPerfil = inputContraseñaPerfil.value.trim();

      // Objeto para almacenar los valores cambiados
      let cambios = {};

      // Verificar si hay cambios en los datos
      if (newInputUsuarioPerfil !== datosUsuario.usuario.trim()) {
        cambios.usuario = newInputUsuarioPerfil;
      }
      if (newInputNombrePerfil !== datosUsuario.nombre.trim()) {
        cambios.nombre = newInputNombrePerfil;
      }
      if (newInputApellidoPerfil !== datosUsuario.apellido.trim()) {
        cambios.apellido = newInputApellidoPerfil;
      }
      if (newInputCorreoPerfil !== datosUsuario.email.trim()) {
        cambios.email = newInputCorreoPerfil;
      }
      if (newInputContraseñaPerfil !== datosUsuario.passw.trim()) {
        cambios.passw = newInputContraseñaPerfil;
      }

      // Añadir el id del usuario al objeto que se pasa al servidor solo si hay cambios
      if (Object.keys(cambios).length > 0) {
        cambios.id = datosUsuario.id;
      }

      // Verificar si hay cambios para guardar
      if (Object.keys(cambios).length > 0) {
        // Guardar cambios si hay diferencias

        // Realizar la lógica para enviar los cambios al servidor
        fetch('../N20_Negocio/N21_Controladores/usuariosControlador.php', {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            "tipo": "actualizarUsuario",
            "datos": cambios
          }),
        })
          .then(response => response.json())
          .then(data => {
            alert(data.mensaje);

            datosUsuario = { ...datosUsuario, ...cambios };
            localStorage.setItem("userInfo", JSON.stringify(datosUsuario));
            location.reload(true);


          })
          .catch(error => {
            console.error('Error al enviar los datos:', error.message);
          });

      } else {
        console.log("No hay cambios para guardar.");
      }
    }
  });
});
