/**
 * Registro en el editor: muestra el mismo render del servidor, sin controles.
 */
( function ( blocks, element, blockEditor, components, ServerSideRender ) {
	blocks.registerBlockType( 'kiwi/descripcion', {
		edit: function ( props ) {
			return element.createElement(
				'div',
				blockEditor.useBlockProps(),
				element.createElement(
					components.Disabled,
					null,
					element.createElement( ServerSideRender, {
						block: 'kiwi/descripcion',
						urlQueryArgs: { post_id: props.context.postId },
					} )
				)
			);
		},
	} );
} )(
	window.wp.blocks,
	window.wp.element,
	window.wp.blockEditor,
	window.wp.components,
	window.wp.serverSideRender
);
