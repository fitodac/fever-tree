var mg = {

	init: function(){

		// Traducciones
		let _lang = $('html').prop('lang');
		let _t = {
					'es': {
						'error_name_empty': 'Parece que olvidaste incluír tu nombre',
						'error_lastname_empty': 'Debes incluír tus apellidos',
						'error_email_valid': 'Debes esceribir una dirección de email válida',
						'error_email_empty': 'Parece que has olvidado escribir tu email',
						'error_phone_empty': 'Por favor, escribe tu número telefónico',
						'error_phone_wrong': 'Parece que el número telefónico no es correcto',
						'error_dni_empty': 'También necesitamos tu número de DNI',
						'error_dni_wrong': '¿Estás seguro de que el DNI es el correcto?',
						'error_birthday_empty': '¿Cuándo es tu cumpleaños?',
						'error_acceptance': 'Ups! Debes aceptar la información sobre protección de datos',
						'error_legals': 'Por favor, confirma que aceptas las Bases Legales de la Promoción'
					},
					'ca': {
						'error_name_empty': '(CA) Parece que olvidaste incluír tu nombre',
						'error_lastname_empty': '(CA) Debes incluír tus apellidos',
						'error_email_valid': '(CA) Debes esceribir una dirección de email válida',
						'error_email_empty': '(CA) Parece que has olvidado escribir tu email',
						'error_phone_empty': '(CA) Por favor, escribe tu número telefónico',
						'error_phone_wrong': '(CA) Parece que el número telefónico no es correcto',
						'error_dni_empty': '(CA) También necesitamos tu número de DNI',
						'error_dni_wrong': '(CA) ¿Estás seguro de que el DNI es el correcto?',
						'error_birthday_empty': '(CA) ¿Cuándo es tu cumpleaños?',
						'error_acceptance': '(CA) Ups! Debes aceptar la información sobre protección de datos',
						'error_legals': '(CA) Por favor, confirma que aceptas las Bases Legales de la Promoción'
					}
				};

		// Input masks
		// https://igorescobar.github.io/jQuery-Mask-Plugin/docs.html#callback-examples
		if( $('#f-phone').length ) $('#f-phone').mask('000-00-00-00', {
			placeholder: '___-__-__-__'
		});
		if( $('#f-dni').length ) $('#f-dni').mask('00.000.000A',{'translation':
				{
					A: {pattern: /[A-Za-z]/}
				}
			});


		if( $('#f-birthday').length ){
			$('#f-birthday').dateDropdowns({
				minAge: 18,
				defaultDateFormat: 'yyyy-mm-dd',
				submitFormat: 'dd/mm/yyyy',
				dayLabel: 'DD',
				monthLabel: 'MM',
				yearLabel: 'YYYY',
				minYear: 1920,
				monthLongValues: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
				initialDayMonthYearValues: ['DD', 'MM', 'YYYY'],
				daySuffixValues: [' ', ' ', ' ', ' ']
			});
		}


		$('#f-name').on('keyup', ()=>{ $('.error-f-name').text('') });
		$('#f-lastname').on('keyup', ()=>{ $('.error-f-lastname').text('') });
		$('#f-email').on('keyup', ()=>{ $('.error-f-email').text('') });
		$('#f-phone').on('keyup', ()=>{ $('.error-f-phone').text('') });
		$('#f-dni').on('keyup', ()=>{ $('.error-f-dni').text('') });
		$('#f-birthday').on('change', ()=>{ $('.error-f-birthday').text('') });
		$('#f-acceptance').on('change', ()=>{ $('.error-f-acceptance').text('') });
		$('#f-legal').on('change', ()=>{ $('.error-f-legal').text('') });




		// Dropzone
		// https://www.dropzonejs.com/
		Dropzone.autoDiscover = false;

		$('#dropZone').dropzone({
			addRemoveLinks: true,
			maxFilesize: 2, // MB
			maxFiles: 1,
			uploadMultiple: false,
			autoProcessQueue: false,
			acceptedFiles: '.jpeg, .jpg, .png',
			init: function() {

				var dzClosure = this;

				this.on('addedfile', function(file){
					$('#dropZone .dz-message-error').addClass('d-none');
					$('.error-f-dropzone').text('');
				});

				this.on('maxfilesexceeded', function(file) {
					this.removeAllFiles();
					this.addFile(file);
				});


				var btnSubmit = document.querySelector('#submit');

				btnSubmit.addEventListener('click', function(e){
					e.preventDefault();
					e.stopPropagation();


					let _formdata = $('#mainForm').serializeArray(),
							_submit = true,
							_re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;



					$.map(_formdata, (val,idx)=>{
						if( val.name == 'f-name' && ( val.value == '' ) ){
							$('.error-f-name').text(_t[_lang].error_name_empty);
							_submit = false;
						}

						if( val.name == 'f-lastname' && ( val.value == '' ) ){
							$('.error-f-lastname').text(_t[_lang].error_lastname_empty);
							_submit = false;
						}

						if( val.name == 'f-email' && !_re.test( val.value ) ){
							$('.error-f-email').text(_t[_lang].error_email_valid);
							_submit = false;
						}

						if( val.name == 'f-email' && ( val.value == '' || val.value.indexOf(' ') >= 0 ) ){
							$('.error-f-email').text(_t[_lang].error_email_empty);
							_submit = false;
						}

						if( val.name == 'f-phone' && ( val.value == '' ) ){
							$('.error-f-phone').text(_t[_lang].error_phone_empty);
							_submit = false;
						}

						if( val.name == 'f-phone' && ( val.value != '' && val.value.length < 12 ) ){
							$('.error-f-phone').text(_t[_lang].error_phone_wrong);
							_submit = false;
						}

						if( val.name == 'f-dni' && ( val.value == '' ) ){
							$('.error-f-dni').text(_t[_lang].error_dni_empty);
							_submit = false;
						}

						if( val.name == 'f-dni' && ( val.value != '' && val.value.length < 11 ) ){
							$('.error-f-dni').text(_t[_lang].error_dni_wrong);
							_submit = false;
						}

						if( val.name == 'f-birthday' && ( val.value == '' ) ){
							$('.error-f-birthday').text(_t[_lang].error_birthday_empty);
							_submit = false;
						}

					});

					if( !$('#f-acceptance:checked').length ){
						$('.error-f-acceptance').text(_t[_lang].error_acceptance);
						_submit = false;
					}

					if( !$('#f-legal:checked').length ){
						$('.error-f-legal').text(_t[_lang].error_legals);
						_submit = false;
					}


					if( !dzClosure.files.length ){
						$('.error-f-dropzone').text('No olvides enviarnos tu ticket de compra');
						_submit = false;
					}else{
						$('.error-f-dropzone').text('');
					}


					// if(_submit) console.log('envio', _submit);
					if(_submit) dzClosure.processQueue();

				});

			},
			sending: function (file, xhr, formData) {
				// console.log(file);

				formData.append( 'name', $('#f-name').val() );
				formData.append( 'lastname', $('#f-lastname').val() );
				formData.append( 'email', $('#f-email').val() );
				formData.append( 'phone', $('#f-phone').val() );
				formData.append( 'birthday', $('#f-birthday').val() );
				formData.append( 'dni', $('#f-dni').val() );
				formData.append( 'lang', $('#f-lang').val() );
			},
			success: function (file, response) {

				// console.log(response);

				if( response.resp ){
					location.href = _lang+'/gracias';
				}

				if( !response.resp ){
					location.href = _lang+'/submit-error';
				}

			},
			error: function (file, response) {
				if( 'error' == file.status ){
					this.removeAllFiles();
					$('#dropZone .dz-message').addClass('dz-error');
					$('#dropZone .dz-message-error').removeClass('d-none');
				}
			}
		});

	}


}








jQuery(document).ready(function(){

	// var _name = ['John', 'Kevin', 'Diane', 'Marianne', 'Donna'],
	// 		_lastname = ['Peters', 'Sommers', 'Heisenberg', 'Parker', 'Stuart'],
	// 		_email = ['fito@commonpeoplei.com', 'fito@commonpeoplei.com', 'fito@commonpeoplei.com', 'fito@commonpeoplei.com', 'fito@commonpeoplei.com'],
	// 		_phone = ['123 123 45 67 89', '123 123 45 67 89', '123 123 45 67 89', '123 123 45 67 89', '123 123 45 67 89'],
	// 		_birthday = ['2001-04-12', '1965-02-30', '1987-05-09', '1990-06-06', '1991-12-10'],
	// 		_dni = ['95.277.555v', '94.534.234v', '43.254.363v', '54.243.423v', '43.431.643v'],
	// 		rand = Math.floor(Math.random() * _name.length);
	//
	// $('#f-name').val(_name[rand]);
	// $('#f-lastname').val(_lastname[rand]);
	// $('#f-email').val(_email[rand]);
	// $('#f-phone').val(_phone[rand]);
	// $('#f-dni').val(_dni[rand]);
	// $('#f-birthday').val(_birthday[rand]);



	mg.init();

	// Previene enviar el formulario al presionar enter
	$(window).keydown(function(event){
		if(event.keyCode == 13) {
			event.preventDefault();
			return false;
		}
	});

});