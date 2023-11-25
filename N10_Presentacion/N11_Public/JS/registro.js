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