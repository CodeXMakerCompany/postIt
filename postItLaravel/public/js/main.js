window.addEventListener("load", function(){
	
	var url = 'http://localhost/laravel/postItLaravel/public/';

	$('.btn-like').css('cursor', 'pointer');
	$('.btn-dislike').css('cursor', 'pointer');

	function like() {
		 	$('.btn-like').unbind('click').click(function() {
			console.log('like');
			$(this).addClass('btn-dislike').removeClass('.btn-like');
			$(this).attr('src', url+'img/heartRed.png');

			$.ajax({
				url: url+'/like/'+$(this).data('id'),
				type: 'GET',
				success: function(response){
					if (response.like) {
						console.log("Has dado like a la publicacion");
					}else{
						console.log("Error al dar like");
					}
					
				}
			});
			

			dislike();
		});
	 } // Boton de like

	 like();
	
	 function dislike() {
	 	// Boton de dislike
		$('.btn-dislike').unbind('click').click(function() {
			console.log('dislike');
			$(this).addClass('btn-like').removeClass('.btn-dislike');
			$(this).attr('src', url+'img/heartGray.png');

			$.ajax({
				url: url+'/dislike/'+$(this).data('id'),
				type: 'GET',
				success: function(response){
					if (response.like) {
						console.log("Has dado dislike a la publicacion");
					}else{
						console.log("Error al dar dislike");
					}
					
				}
			});

			like();
		});
	 }

	 dislike();
	

});