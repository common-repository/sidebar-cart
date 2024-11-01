$ = jQuery;

$( document ).ready( function() {
	$( '.scw-trigger, .scw-close' ).click( function( e ) {
		e.preventDefault();
		scw_container = $( '.scw-container' );
		if( $( '.scw-open' ).length ){
			$( scw_container ).animate({
				'marginRight': '-350px'
			}, 350 );
			$( 'body' ).removeClass( 'scw-open' );
		}
		else{
			$( scw_container ).animate({
				'marginRight': '0'
			}, 350 );
			$( 'body' ).addClass( 'scw-open' );
		}
	});
	$( '.scw-overlay' ).click( function() {
		scw_container = $( '.scw-container' );
		if ( !scw_container.is( event.target ) && !scw_container.has( event.target ).length ) {
			$( scw_container ).animate({
				'marginRight': '-350px'
			}, 350 );
			$( 'body' ).removeClass( 'scw-open' );
		}
	});
});