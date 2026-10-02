/**
 * Actualiza el conteo del carrito sin recargar.
 *
 * Solo usa superficies públicas de WooCommerce:
 * - los eventos `wc-blocks_added_to_cart` y `wc-blocks_removed_from_cart`
 *   (Woo también los dispara cuando el origen es el `added_to_cart` de jQuery);
 * - `GET /wc/store/v1/cart` del Store API, campo `items_count`.
 *
 * Si algo falla, no se toca nada: queda el número que pintó el servidor.
 */
( function () {
	const enlaces = document.querySelectorAll( '.kiwi-carrito[data-kiwi-api]' );

	if ( ! enlaces.length || ! window.fetch ) {
		return;
	}

	const api = enlaces[ 0 ].dataset.kiwiApi;

	function pintar( cuenta ) {
		enlaces.forEach( function ( enlace ) {
			const plantilla =
				cuenta === 1 ? enlace.dataset.kiwiUna : enlace.dataset.kiwiVarias;
			const badge = enlace.querySelector( '.kiwi-carrito__badge' );

			enlace.setAttribute( 'aria-label', plantilla.replace( '%d', cuenta ) );

			if ( badge ) {
				badge.textContent = String( cuenta );
				badge.hidden = cuenta < 1;
			}
		} );
	}

	function actualizar() {
		fetch( api, {
			credentials: 'same-origin',
			headers: { Accept: 'application/json' },
		} )
			.then( function ( respuesta ) {
				return respuesta.ok ? respuesta.json() : Promise.reject( respuesta );
			} )
			.then( function ( carrito ) {
				if ( carrito && Number.isInteger( carrito.items_count ) ) {
					pintar( carrito.items_count );
				}
			} )
			.catch( function () {} );
	}

	document.addEventListener( 'wc-blocks_added_to_cart', actualizar );
	document.addEventListener( 'wc-blocks_removed_from_cart', actualizar );

	// Al volver con el botón «atrás», la página sale del caché del navegador
	// con el conteo viejo.
	window.addEventListener( 'pageshow', function ( evento ) {
		if ( evento.persisted ) {
			actualizar();
		}
	} );
} )();
