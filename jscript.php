$(document).ready(function(){
	$(document).on('submit', '#saveForm', function(event){
		event.preventDefault();
		$form = $(this);
		$.ajax({
			url: $form.attr('action'),
			method: $form.attr('method'),
			contentType:false,
			processData: false,
			dataType:'json',
			data: new FormData(this),
			success: function(response){
					$('#message').html(response);
					$('#message').delay(3000).fadeOut('slow');
					$('#saveForm')[0].reset();
					$('#message').show();
					show();
					 $('html,body').animate({ scrollTop: $("#container").offset().top}, 'slow');
			}
		});
	});
});

$(document).ready(function(){
	show();
});

function show(){
	$.ajax({
		url: 'controller.php',
		method: 'post',
		dataType: 'json',
		data: {dataFetch:1},
		success: function(response){
			$('.table').html(response);
		}
	});
}


$(document).ready(function(){
	$(document).on('click', '#edit', function(event){
		event.preventDefault();
		$anchor = $(event.target);
		var id = $anchor.attr('user-data');
		$.ajax({
			url: 'controller.php',
			method: 'post',
			dataType: 'json',
			data: {edit:1, user_id:id},
			success:function(response){
				$('#UpdateFormView').html(response);
				$('#saveForm').hide();
				$('html,body').animate({ scrollTop: $(".container").offset().top}, 'slow');
			}
		});
	});
});


$(document).ready(function(){
	$(document).on('click', '#cancel', function(event){
		event.preventDefault();
		$('#saveForm').show();
		$('#updateForm').hide();
	});
});

$(document).ready(function(){
	$(document).on('click', '#delete', function(event){
		event.preventDefault();
		$anchor = $(event.target);
		var id = $anchor.attr('user-data');
		$.ajax({
			url: 'controller.php',
			method: 'post',
			dataType: 'json',
			data: {delete:1, user_id:id},
			success:function(response){
				$('#message').html(response);
				 $('#message').delay(3000).fadeOut('slow');
				 $('#message').show();
				show();
				 $('html,body').animate({ scrollTop: $("#message").offset().top}, 'slow');
			}
		});
	});
});

$(document).ready(function(){
	$(document).on('submit', '#updateForm', function(event){
		event.preventDefault();

		$form = $(this);
		$.ajax({
			url: $form.attr('action'),
			method: $form.attr('method'),
			dataType: 'json',
			data: $form.serialize(),
			success: function(response){
				$('#message').html(response);
				 $('#message').delay(3000).fadeOut('slow');
				 $('#message').show();
				show();
				 $('html,body').animate({ scrollTop: $("#message").offset().top}, 'slow');
			}
		});
	});
});