$(document).ready(function(){

	$('.statuses').click(function(){

		var status=$('.statuses').val();
		if(status=='for sale' || status=='phase out' || status=='obsolete'){
			//$('.required').css('border-color','red');
			$('.req').addClass('required');
			//$('.bold').css('font-weight','bold');
		}else{
			$('.req').removeClass('required');
			$('.required').css('border-color','lightgrey');
			//$('.bold').css('font-weight','normal');
		}

		if(status=='delivered' || status=='ready'){
			$('.req').addClass('required');
		}else{
			$('.req').removeClass('required');
			$('.required').css('border-color','lightgrey');
		}

		if(status=='delivered'){
			$('.req1').addClass('required');
		}else{
			$('.req1').removeClass('required');
			$('.required').css('border-color','lightgrey');
		}


	});

	$('.types').click(function(){

		var type=$('.types').val();
		if(type=='trebovanje'){
			$('.order').addClass('required');
		}else{
			$('.order').removeClass('required');
			$('.required').css('border-color','lightgrey');
		}

	});

	/*$('.stat').click(function(){

		var stat=$('.stat').val();
		if(stat=='delivered'){
			$('.req').addClass('required');
			$('.req1').addClass('required');
		}else{
			$('.req').removeClass('required');
			$('.req1').removeClass('required');
			$('.required').css('border-color','lightgrey');
		}

		if(stat=='ready'){
			$('.req').addClass('required');
		}else{
			$('.req').removeClass('required');
			$('.required').css('border-color','lightgrey');
		}

	});*/
});