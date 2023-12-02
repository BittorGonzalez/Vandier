//Colocar datos usuario en el formulario
const inputUsuarioPerfil = document.querySelector("#inputUsername");
const inputNombrePerfil = document.querySelector("#inputFirstName");
const inputApellidoPerfil = document.querySelector("#inputLastName");
const inputCorreoPerfil = document.querySelector("#inputOrgName");
const inputContraseñaPerfil = document.querySelector("#inputLocation");

let datosUsuario = JSON.parse(localStorage.getItem("userInfo"));

inputUsuarioPerfil.value = datosUsuario.usuario;
inputNombrePerfil.value = datosUsuario.nombre;
inputApellidoPerfil.value = datosUsuario.apellido;
inputCorreoPerfil.value = datosUsuario.email;
inputContraseñaPerfil.value = datosUsuario.passw;

//Guardar cambios
const btnGuardar = document.querySelector(".btnGuardar");

btnGuardar.addEventListener("click", () => {
  let newInputUsuarioPerfil = inputUsuarioPerfil.value;
  let newInputNombrePerfil = inputNombrePerfil.value;
  let newInputApellidoPerfil = inputApellidoPerfil.value;
  let newInputCorreoPerfil = inputCorreoPerfil.value;
  let newInputContraseñaPerfil = inputContraseñaPerfil.value;

   // Comparar con los valores originales
   if (
    newInputUsuarioPerfil !== datosUsuario.usuario ||
    newInputNombrePerfil !== datosUsuario.nombre ||
    newInputApellidoPerfil !== datosUsuario.apellido ||
    newInputCorreoPerfil !== datosUsuario.email ||
    newInputContraseñaPerfil !== datosUsuario.passw
  ) {
    
    let infoJson = [
        {'nombre': newInputUsuarioPerfil,
        'apellido': newInputApellidoPerfil,
        'usuario':    
    }
    ]

    
  } else {
    console.log("No hay cambios para guardar");
  }
});
