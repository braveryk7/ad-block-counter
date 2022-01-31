import { __ } from '@wordpress/i18n';

import { addPrefix } from '../../utils/constant';

export const ActivateRinker = ( props: { rinkerStatus: boolean } ) => {
	const disabledTitle = __(
		'This plugin requires to Rinker enabled.',
		'ad-block-counter'
	);
	const disabledMessage = [
		__( 'Current Rinker status: ', 'ad-block-counter' ) +
			__( 'Disabled', 'ad-block-counter' ),
		__(
			'Rinker to be enabled on the Installed Plugins page.',
			'ad-block-counter'
		),
	];
	const uninstalledTitle = __(
		'This plugin requires to Rinker installed.',
		'ad-block-counter'
	);
	const uninstalledMessage = [
		__( 'Current Rinker status: ', 'ad-block-counter' ) +
			__( 'Uninstalled', 'ad-block-counter' ),
		__(
			'Rinker is a product link management plugin that is completely free to use.',
			'ad-block-counter'
		),
	];

	return (
		<div className={ `${ addPrefix( '-item-wrapper' ) }` }>
			<h2>{ props.rinkerStatus ? disabledTitle : uninstalledTitle }</h2>
			{ props.rinkerStatus
				? disabledMessage.map( ( value, i ) => (
						<p key={ i }>{ value }</p>
				  ) )
				: uninstalledMessage.map( ( value, i ) => (
						<p key={ i }>{ value }</p>
				  ) ) }
			<p>
				<a
					href="https://oyakosodate.com/rinker/"
					target="_blank"
					rel="noreferrer"
				>
					{ __( 'Rinker Official web site', 'ad-block-counter' ) }
				</a>
			</p>
		</div>
	);
};
