jQuery( document ).ready( function( $ ){
	$( 'body' ).keydown(function( event ){
		if( event.shiftKey === true && event.which === 65 ){
			$( '#wpadminbar' ).slideToggle( 'fast' );
			$( 'html' ).toggleClass( 'spaceClear' );
		}
	});
});
