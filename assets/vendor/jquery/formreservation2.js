$(function(){
	var $formReservation = $("#reservationForm");

	$.validator.addMethod("noSpace", function(value, element){
		return value == '' || value.trim().length != 0
	}, "Spaces are not allowed!");
	
	$.validator.addMethod("usernamevalues", function (value, element){
		return this.optional(element) || /^[a-zA-Z0-9\.\_\@\s]+$/i.test(value);
	}, "Must consist of alphabetical, numeric, dot, @ or underscore only!");

	$.validator.addMethod("lettersonly", function (value, element){
		return this.optional(element) || /^[a-zA-Z\s]+$/i.test(value);
	}, "Must consist of letters only!");

	$.validator.addMethod("numbersonly", function (value, element){
		return this.optional(element) || /^[0-9]+$/i.test(value);
	}, "Must consist of numbers!");

	$.validator.addMethod("addressvalues", function (value, element){
		return this.optional(element) || /^[a-zA-Z0-9\.\-\,\s]+$/i.test(value);
	}, "Must consist of alphabetical, numeric, dot, - or underscore only!");

	if ($formReservation.length) {
		$formReservation.validate({
			rules:{
				fullname:{
					required: true,
					noSpace: true,
					lettersonly: true
				},
				age:{
					required: true,
					noSpace: true,
					numbersonly: true,
					maxlength: 3
				},
				gender:{
					required: true,
				},
				date_of_birth:{
					required: true
				},
				date_of_death:{
					required: true
				},
				date_of_burial:{
					required: true
				}
			},
			messages:{
				fullname:{
					required: 'Please enter full name!'
				},
				age:{
					required: 'Please enter age!',
					maxlength: 'Age length must be equal or lesser than 3!'
				},
				gender:{
					required: 'Please select gender!'
				},
				date_of_birth:{
					required: 'Please select date of birth!'
				},
				date_of_death:{
					required: 'Please select date of death!'
				},
				date_of_burial:{
					required: 'Please select date of burial!'
				}
			},
			errorPlacement: function(error, element){
				error.appendTo(element.parents(".validate"));
			}
		})
	}
})