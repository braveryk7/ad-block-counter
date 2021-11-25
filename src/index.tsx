import { render } from '@wordpress/element';
import { __ } from '@wordpress/i18n';

import { Toggle } from './component/molecules/Toggle';

const AdminPage = () => {
	return (
		<div id="wrap">
			<h1>{ __( 'Ad Block Counter Settings', 'ad-block-counter' ) }</h1>
			<Toggle />
		</div>
	);
};

render( <AdminPage />, document.getElementById( 'ad-block-counter-settings' ) );
