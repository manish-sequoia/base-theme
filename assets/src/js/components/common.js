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

		this.primaryMenu();

	},

	primaryMenu() {

		// Get all the link elements within the primary menu.
		let i, len;

		const menu = document.querySelector( '.primary-navigation' )

		if ( ! menu ) {

			return false;

		}

		const links = menu.getElementsByTagName( 'a' );

		// Each time a menu link is focused or blurred, toggle focus.
		for ( i = 0, len = links.length; i < len; i++ ) {

			links[i].addEventListener( 'focus', toggleFocus, true );
			links[i].addEventListener( 'blur', toggleFocus, true );
		}

		// Sets or removes the .focus class on an element.
		function toggleFocus() {
			let self = this;

			// Move up through the ancestors of the current link until we hit .primary-menu.
			while ( -1 === self.className.indexOf( 'primary-menu' ) ) {

				// On li elements toggle the class .focus.
				if ( 'li' === self.tagName.toLowerCase() ) {

					if ( - 1 !== self.className.indexOf( 'focus' ) ) {

						self.className = self.className.replace( ' focus', '' );

					} else {

						self.className += ' focus';

					}
				}

				self = self.parentElement;
			}
		}
	}
};

/**
 * Load the script after DOM Content Loaded.
 */
window.addEventListener( 'DOMContentLoaded', () => {
	common.init();
} );
