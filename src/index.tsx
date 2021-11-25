import { render } from '@wordpress/element';
import { __ } from '@wordpress/i18n';

const AdminPage = () => {
	return (
		<div id="wrap">
			<h1>{ __( 'Ad Block Counter Settings', 'ad-block-counter' ) }</h1>
		</div>
	);
};

render( <AdminPage />, document.getElementById( 'ad-block-counter-settings' ) );
