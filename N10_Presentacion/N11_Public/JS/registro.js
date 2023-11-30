console.log("hola")

let currentStep = 1;

  function nextStep(step) {
    if (step === currentStep && step < 3) {
      $(`#step${step}`).removeClass('active');
      currentStep++;
      $(`#step${currentStep}`).addClass('active');
    }
  }

  function prevStep(step) {
    if (step === currentStep && step > 1) {
      $(`#step${step}`).removeClass('active');
      currentStep--;
      $(`#step${currentStep}`).addClass('active');
    }
  }
// Obtener referencias a los elementos del formulario
const usuarioInput = document.getElementById('usuarioregistro');
const nombreInput = document.getElementById('nombreregistro');
const apellidoInput = document.getElementById('apellidoregistro');
const emailInput = document.getElementById('emailregistro');
const contraseñaInput = document.getElementById('contraseñaregistro');
// Escuchar el evento click del botón "Registrarse" en el segundo paso
document.getElementById('multipasos-form').addEventListener('click', function (event) {
  // Verificar si el elemento clickeado es el botón "Registrarse" en el segundo paso
  if (event.target && event.target.id === 'registrarse-btn') {
      // Validar que todos los campos estén llenos
      if (!areAllFieldsFilled()) {
          // Mostrar la alerta roja y salir sin enviar la solicitud
          showStep(3, false);
          return;
      }

      // Crear un objeto JSON con los datos del formulario
      const formData = {
          usuario: usuarioInput.value,
          nombre: nombreInput.value,
          apellido: apellidoInput.value,
          email: emailInput.value,
          contraseña: contraseñaInput.value,
      };

      // Convertir el objeto JSON a una cadena
      const jsonData = JSON.stringify(formData);

      // Enviar la cadena JSON al controlador PHP usando Fetch API
      fetch('../N20_Negocio/N21_Controladores/usuariosControlador.php', {
          method: 'PUT',
          headers: {
              'Content-Type': 'application/json',
          },
          body: jsonData,
      })
      .then(response => {
          if (!response.ok) {
              throw new Error('Error en la solicitud');
          }
          // Datos enviados correctamente, mostrar el paso 3 con la alerta verde
          showStep(3, true);
          console.log('Datos enviados correctamente');
      })
      .catch(error => {
          // Error al enviar los datos, mostrar el paso 3 con la alerta roja
          showStep(3, false);
          console.error('Error al enviar los datos:', error.message);
      });
  }
});

// Función para mostrar u ocultar un paso
function showStep(step, success) {
  // Ocultar todos los pasos
  document.querySelectorAll('.step').forEach(stepElement => {
      stepElement.style.display = 'none';
  });

  // Mostrar el paso deseado
  const stepElement = document.getElementById(`step${step}`);
  stepElement.style.display = 'block';

  // Mostrar u ocultar la alerta verde/roja según el éxito
  const successAlert = stepElement.querySelector('.alert-success');
  const errorAlert = stepElement.querySelector('.alert-danger');

  if (!success) {
      // Si no hay éxito, mostrar la alerta roja
      successAlert.style.display = 'none';
      errorAlert.style.display = 'block';
  } else {
      // Si hay éxito, mostrar la alerta verde
      successAlert.style.display = 'block';
      errorAlert.style.display = 'none';
  }
}

// Función para verificar si todos los campos están llenos
function areAllFieldsFilled() {
  const fields = [usuarioInput, nombreInput, apellidoInput, emailInput, contraseñaInput];
  return fields.every(field => field.value.trim() !== '');
}




