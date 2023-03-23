$(document).ready(function() {
    $('form').submit(function(event) {
      event.preventDefault();
  
      var name = $('#name').val();
      var email = $('#email').val();
      var message = $('#message').val();
      var error = '';
  
      // Validar que el nombre no esté vacío
      if (name.trim() == '') {
        error += 'Por favor ingrese su nombre.\n';
      }
  
      // Validar que el correo electrónico sea válido
      if (!isValidEmail(email)) {
        error += 'Por favor ingrese un correo electrónico válido.\n';
      }
  
      // Validar que el mensaje no esté vacío
      if (message.trim() == '') {
        error += 'Por favor ingrese un mensaje.\n';
      }
  
      // Si hay errores, mostrarlos y detener el envío del formulario
      if (error != '') {
        alert(error);
      } else {
        sendEmail();
      }
    });
  });
  
  // Función para validar dirección de correo electrónico
  function isValidEmail(email) {
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
  }
  
  function sendEmail() {
    $.ajax({
      url: 'index.php',
      method: 'POST',
      data: $('#contact-form').serialize(),
      success: function(response) {
        $('#contact-form')[0].reset();
        alert('¡El correo electrónico ha sido enviado!');
      },
      error: function(error) {
        alert('¡Hubo un error al enviar el correo electrónico!');
      }
    });
  }