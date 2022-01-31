import { __ } from '@wordpress/i18n';

import { addPrefix } from '../../utils/constant';

export const InstallRinker = () => {
	return (
		<div className={ `${ addPrefix( '-item-wrapper' ) }` }>
			<h2>
				{ __(
					'This plugin requires to Rinker installed.',
					'ad-block-counter'
				) }
			</h2>
			<p>
				{ __( 'Current Rinker status', 'ad-block-counter' ) }:{ ' ' }
				{ __( 'Uninstalled', 'ad-block-counter' ) }
			</p>
			<p>
				<a
					href="https://oyakosodate.com/rinker/"
					target="_blank"
					rel="noreferrer"
				>
					{ __( 'Rinker Official web site', 'ad-block-counter' ) }
				</a>
				{ __( 'to download/install Rinker.', 'ad-block-counter' ) }
			</p>
			<p>
				{ __(
					'Rinker is a product link management plugin that is completely free to use.',
					'ad-block-counter'
				) }
			</p>
		</div>
	);
};
