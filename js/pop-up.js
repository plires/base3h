jQuery( document ).ready(function() {

	const pop_up_overlay = document.getElementById('pop_up_overlay')
	const pop_up = document.getElementById('pop_up')
	const form = document.getElementById('form_pop_up');
	const email = document.getElementById('email');
	const spinner = document.getElementById('spinner');

	var cookie_expire = 20; // days
	var cookie = localStorage.getItem("pop_up_base3home");

  if(cookie == undefined || cookie == null) {
      cookie = 0;
  }

  if (!cookie) {
  	if(((new Date()).getTime() - cookie) / (1000 * 60 * 60 * 24) > cookie_expire) {

  		setTimeout(function(){
				pop_up_overlay.classList.toggle('show')
				pop_up.classList.toggle('show')
			}, 5000)

  	}
  }

  function validateEmail(email) {
	  const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	  return re.test(email);
	}

	function loading() {
		spinner.classList.toggle('show')
	}

  function processForm(e) {
	  e.preventDefault()

	  let validEmail = validateEmail(email.value)

	  if (validEmail) {

	  	loading()
	  	jQuery("#popup_response").html("")

	  	jQuery.ajax({
	      type: "POST",
	      url: jQuery("#form_pop_up").attr("action"),
	      data: jQuery("#form_pop_up").serialize(),
	      success: (data) => {
	      	let response = JSON.parse(data)
	      	if (response.status) {
	        	jQuery("#popup_response").html("<p class='no_close'; style='text-align: center; color: green;'>" + response.msg + "</p>")
	        	loading()
	      	} else {
	        	jQuery("#popup_response").html("<p class='no_close'; style='text-align: center; color: red;'>" + response.msg + "</p>")
	        	loading()
	      	}
	      }
		  })

	  } 

	  // Debe devolver falso para evitar el comportamiento predeterminado del formulario.
	  return false;
	}

	if (form.attachEvent) {
    form.attachEvent("submit", processForm);
	} else {
    form.addEventListener("submit", processForm);
	}

	//funcion para cualquier clic en el documento
	document.addEventListener("click", function(e){
	//obtiendo informacion del DOM para  
	var clic = e.target;
	if( pop_up.classList.contains( 'show' ) && !clic.classList.contains( 'no_close' ) ){
		localStorage.setItem("pop_up_base3home", (new Date()).getTime());
		pop_up_overlay.classList.toggle('show')
		pop_up.classList.toggle('show')
	} 
	}, false);

});
