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
  function collectFormData() {
    // Obtener referencias a los campos del formulario
    var usuario = document.querySelector('#step1 input[name="Usuario"]').value;
    var nombre = document.querySelector('#step1 input[name="Nombre"]').value;
    var apellido = document.querySelector('#step1 input[name="Apellido"]').value;
    var email = document.querySelector('#step2 input[name="Email"]').value;
    var contraseña = document.querySelector('#step2 input[name="Contraseña"]').value;


    // Crear un objeto JSON con los datos recopilados
    var formData = {
        usuario: usuario,
        nombre: nombre,
        apellido: apellido,
        email: email,
        contraseña: contraseña,
    };

    // Convertir el objeto JSON a una cadena
    var jsonData = JSON.stringify(formData);

    // Enviar la cadena JSON al controlador PHP (puedes usar AJAX para esto)
    // Ejemplo usando fetch:
    fetch('tu_controlador.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: jsonData
    })
    .then(response => response.json())
    .then(data => {
        // Manejar la respuesta del controlador si es necesario
        console.log(data);
    })
    .catch(error => {
        console.error('Error al enviar datos al servidor:', error);
    });
}