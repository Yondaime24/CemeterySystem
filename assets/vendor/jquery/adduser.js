$(function(){
	var $registerForm = $("#register");

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
				user_type:{
					required: true
				},
				fname:{
					required: true,
					noSpace: true,
					lettersonly: true
				},
				mname:{
					noSpace: true,
					lettersonly: true
				},
				lname:{
					required: true,
					noSpace: true,
					lettersonly: true
				},
				age:{
					required: true,
				},
				birthday:{
					required: true,
				},
				gender:{
					required: true,
				},
				residential_address:{
					required: true,
					noSpace: true,
					addressvalues: true,
					minlength: 5
				},
				email_address:{
					required: true,
					noSpace: true
				},
				contact_number:{
					required: true,
					noSpace: true,
					numbersonly: true,
					maxlength: 11,
					minlength: 11
				},
				username:{
					required: true,
					noSpace: true,
					usernamevalues: true,
					minlength: 8
				},
				password:{
					required: true,
					minlength: 8
				},
				confirm_password:{
					required: true,
					minlength: 8,
					equalTo: '#passWord'
				}
			},
			messages:{
				user_type:{
					required: 'Please select user type!'
				},
				fname:{
					required: 'Please enter first name!'
				},
				lname:{
					required: 'Please enter last name!'
				},
				age:{
					required: 'Please select age!'
				},
				birthday:{
					required: 'Please select birthdate!'
				},
				gender:{
					required: 'Please select gender!'
				},
				residential_address:{
					required: 'Please enter residential address!',
					minlength: 'Residential address length must be equal or greater than 8!'
				},
				contact_number:{
					required: 'Please enter contact number!',
					minlength: 'Contact number length must be equal to 11!',
					maxlength: 'Contact number length must be equal to 11!'
				},
				email_address:{
					required: 'Please enter email address!'
				},
				username:{
					required: 'Please enter username!',
					minlength: 'Username length must be equal or greater than 8!'
				},
				password: {
					required: 'Please enter password!',
					minlength: 'Password length must be equal or greater than 8!'
				},
				confirm_password: {
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