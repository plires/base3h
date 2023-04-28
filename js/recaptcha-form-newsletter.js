// Generar la respuesta de reCAPTCHA al cargar la página
grecaptcha.ready(function() {
  grecaptcha.execute('6Le0G8YlAAAAAKzIgs8s9bC6aB_68o3yeQdQxl8H', { action: 'recaptcha_form_newsletter' })
    .then(function(response) {
      // Enviar la respuesta al servidor o hacer algo con ella
      document.getElementById('g-recaptcha-response-newsletter').value = response;
      document.getElementById('g-recaptcha-response-pop').value = response;
    });
});