$(document).ready(function() {

	$('.enter .reg').magnificPopup({
		items: [
			{
				src: '#reg-popup',
				type: 'inline',
			}
		]
	});

	$('.enter .auth').magnificPopup({
		items: [
			{
				src: '#auth-popup',
				type: 'inline',
			}
		]
	});
	
});

$('.enter .top_wrapper').css('height', $(window).height());

$( window ).resize(function(){
	$('.enter .top_wrapper').css('height', $(window).height());
});


$( '#reg-popup input, #auth-popup input' ).on( "click", function(){
	$( '.error' ).css( 'display', 'none' );
});

$( '.enter button' ).on( "click", function(){
	$( '.error' ).css( 'display', 'none' );
	$( '#reg-popup input' ).val('');
});