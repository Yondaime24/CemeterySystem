$(function(){
	var $registerForm = $("#register2");

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
	}, "Must consist of numbers only!");

	$.validator.addMethod("addressvalues", function (value, element){
		return this.optional(element) || /^[a-zA-Z0-9\.\-\,\s]+$/i.test(value);
	}, "Must consist of alphabetical, numeric, dot, - or underscore only!");

	if ($registerForm.length) {
		$registerForm.validate({
			rules:{
				fname2:{
					required: true,
					noSpace: true,
					lettersonly: true
				},
				mname2:{
					noSpace: true,
					lettersonly: true
				},
				lname2:{
					required: true,
					noSpace: true,
					lettersonly: true
				},
				age2:{
					required: true,
				},
				birthday2:{
					required: true,
				},
				gender2:{
					required: true,
				},
				residential_address2:{
					required: true,
					noSpace: true,
					addressvalues: true,
					minlength: 5
				},
				email_address2:{
					required: true,
					noSpace: true
				},
				contact_number2:{
					required: true,
					noSpace: true,
					numbersonly: true,
					maxlength: 11,
					minlength: 11
				},
				username2:{
					required: true,
					noSpace: true,
					usernamevalues: true,
					minlength: 8
				},
				password2:{
					required: true,
					minlength: 8
				},
				confirm_password2:{
					required: true,
					minlength: 8,
					equalTo: '#passWord2'
				}
			},
			messages:{
				fname2:{
					required: 'Please enter first name!'
				},
				lname2:{
					required: 'Please enter last name!'
				},
				age2:{
					required: 'Please select age!'
				},
				birthday2:{
					required: 'Please select birthdate!'
				},
				gender2:{
					required: 'Please select gender!'
				},
				residential_address2:{
					required: 'Please enter residential address!',
					minlength: 'Residential address length must be equal or greater than 8!'
				},
				contact_number2:{
					required: 'Please enter contact number!',
					minlength: 'Contact number length must be equal to 11!',
					maxlength: 'Contact number length must be equal to 11!'
				},
				email_address2:{
					required: 'Please enter email address!'
				},
				username2:{
					required: 'Please enter username!',
					minlength: 'Username length must be equal or greater than 8!'
				},
				password2: {
					required: 'Please enter password!',
					minlength: 'Password length must be equal or greater than 8!'
				},
				confirm_password2: {
					required: 'Please confirm password!',
					equalTo: 'Passwords does not match!',
					minlength: 'Confirm password length must be equal or greater than 8!'
				}
			},
			errorPlacement: function(error, element){
				error.appendTo(element.parents(".validate"));
			}
		})
	}
})