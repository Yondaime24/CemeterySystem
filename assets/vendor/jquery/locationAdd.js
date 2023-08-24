$(function(){
	var $locationForm = $("#location");

	$.validator.addMethod("noSpace", function(value, element){
		return value == '' || value.trim().length != 0
	}, "Spaces are not allowed!");
	
	$.validator.addMethod("lettersonly", function (value, element){
		return this.optional(element) || /^[a-zA-Z\s]+$/i.test(value);
	}, "Must consist of letters only!");

	$.validator.addMethod("numbersonly", function (value, element){
		return this.optional(element) || /^[0-9]+$/i.test(value);
	}, "Must consist of numbers only!");

	if ($locationForm.length) {
		$locationForm.validate({
			rules:{
				block:{
					required: true,
					noSpace: true,
					lettersonly: true,
					maxlength: 1
				},
				number:{
					required: true,
					numbersonly: true
				}
			},
			messages:{
				block:{
					required: 'Please enter location block!',
					maxlength: 'Length must only be equal to 1!'
				},
				number: {
					required: 'Please enter location number!',
				}
			},
			errorPlacement: function(error, element){
				error.appendTo(element.parents(".validate"));
			}
		})
	}
})