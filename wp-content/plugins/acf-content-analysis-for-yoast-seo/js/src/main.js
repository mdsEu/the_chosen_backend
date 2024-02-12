/* global jQuery, YoastSEO, wp, YoastACFAnalysis: true */
/* exported YoastACFAnalysis */

const App = require( "./app.js" );

/**
 * Initializes the YoastACFAnalysis app.
 *
 * @returns {void}
 */
function initializeYoastACFAnalysis() {
	YoastACFAnalysis = new App();
}

wp.domReady( function() {
	if ( ! ( YoastSEO && YoastSEO.app ) ) {
		// Give it one more attempt in 100ms.
		setTimeout( initializeYoastACFAnalysis, 100 );
		return;
	}

	initializeYoastACFAnalysis();
} );
