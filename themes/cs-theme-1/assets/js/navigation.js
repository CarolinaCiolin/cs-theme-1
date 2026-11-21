/**
 * Alterna o mesmo menu entre o cabeçalho e o painel modal.
 *
 * @package CS_Theme_1
 */

(() => {
	'use strict';

	const panel      = document.getElementById( 'cs-menu-panel' );
	const opener     = document.getElementById( 'cs-menu-open' );
	const closer     = document.getElementById( 'cs-menu-close' );
	const navigation = document.getElementById( 'cs-header-navigation' );

	if ( ! panel || ! opener || ! closer || ! navigation || typeof panel.showModal !== 'function' ) {
		return;
	}

	const desktop     = window.matchMedia( '(min-width: 80em)' );
	const placeholder = document.createComment( 'cs-primary-navigation' );
	navigation.before( placeholder );

	function syncLayout() {
		if ( desktop.matches ) {
			const restoreDesktopFocus = panel.open || document.activeElement === opener;
			const focusedLink         = navigation.contains( document.activeElement ) ? document.activeElement : null;

			panel.close();
			placeholder.after( navigation );
			opener.hidden = true;

			if ( restoreDesktopFocus ) {
				const target = focusedLink || navigation.querySelector( 'a' );
				if ( target ) {
					target.focus();
				}
			}
			return;
		}

		const moveFocus = navigation.contains( document.activeElement );
		opener.hidden   = false;
		panel.append( navigation );
		if ( moveFocus ) {
			opener.focus();
		}
	}

	function openMenu() {
		panel.showModal();
		document.documentElement.classList.add( 'cs-menu-active' );
		closer.focus();
	}

	function closeFromBackdrop( event ) {
		if ( event.target !== panel ) {
			return;
		}
		const bounds = panel.getBoundingClientRect();
		if ( event.clientX < bounds.left || event.clientX > bounds.right ) {
			panel.close();
		}
	}

	function restoreFocus() {
		document.documentElement.classList.remove( 'cs-menu-active' );
		if ( ! desktop.matches && ! panel.open ) {
			opener.focus();
		}
	}

	opener.addEventListener( 'click', openMenu );
	closer.addEventListener( 'click', () => panel.close() );
	panel.addEventListener( 'click', closeFromBackdrop );
	panel.addEventListener( 'close', restoreFocus );
	desktop.addEventListener( 'change', syncLayout );
	syncLayout();
})();
