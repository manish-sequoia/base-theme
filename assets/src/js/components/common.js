/**
 * Common JS.
 *
 * @type {Object}
 */
const common = {

	/**
	 * Initialize.
	 *
	 * @return {void}
	 */
	init() {

		// Get the modal
		const modal = document.getElementById( 'popup_advert_modal' );

		// Get the <span> element that closes the modal
		const modalClose = document.getElementById( 'popup_advert_close' );

		// When the user clicks on <span> (x), close the modal
		modalClose.onclick = function() {

			modal.style.display = 'none';

		}

		// When the user clicks anywhere outside of the modal, close it
		window.onclick = function( event) {

			if ( modal === event.target ) {

				modal.style.display = 'none';

			}

		}

		window.onload = function() {

			setTimeout(

				function() {

					modal.style.display = 'block'

				},

				5000
			);

		}

	},

};

/**
 * Load the script after DOM Content Loaded.
 */
window.addEventListener( 'DOMContentLoaded', () => {

	common.init();

} );
