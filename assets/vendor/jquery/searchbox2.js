$(function(){
	var $searchForm = $("#searchbox");

	$.validator.addMethod("noSpace", function(value, element){
		return value == '' || value.trim().length != 0
	}, "Spaces are not allowed!");
	
	$.validator.addMethod("lettersonly", function (value, element){
		return this.optional(element) || /^[a-zA-Z\s]+$/i.test(value);
	}, "Letters only please!");

	

	if ($searchForm.length) {
		$searchForm.validate({
			rules:{
				search:{
					required: true,
					noSpace: true,
					lettersonly: true,
					minlength: 10
				}
			},
			messages:{
				search:{
					required: 'Required! Please enter full name'
				}
			},
			errorPlacement: function(error, element){
				error.appendTo(element.parents(".box"));
			}
		})
	}
})