import { __ } from '@wordpress/i18n';

import { addPrefix } from '../../utils/constant';

export const ActivateRinker = () => {
	return (
		<div className={ `${ addPrefix( '-item-wrapper' ) }` }>
			<h2>
				{ __(
					'This plugin requires to Rinker enabled.',
					'ad-block-counter'
				) }
			</h2>
			<p>
				{ __( 'Current Rinker status', 'ad-block-counter' ) }:{ ' ' }
				{ __( 'Disabled', 'ad-block-counter' ) }
			</p>
			<p>
				{ __(
					'Rinker to be enabled on the Installed Plugins page.',
					'ad-block-counter'
				) }
			</p>
		</div>
	);
};
