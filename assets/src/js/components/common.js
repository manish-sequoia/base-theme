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

		return true;

	},

};

/**
 * Load the script after DOM Content Loaded.
 */
window.addEventListener( 'DOMContentLoaded', () => {

	common.init();

} );
