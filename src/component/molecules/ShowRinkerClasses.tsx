import { useContext } from '@wordpress/element';

import { apiContext } from '../..';

export const ShowRinkerClasses = () => {
	const { apiData } = useContext( apiContext );

	return (
		<div className="rinker-class-wrapper">
			{ Object.entries( apiData.abc_rinker_classes! ).map(
				( [ key, value ]: any, i ) => (
					<div className="rinker-class-items" key={ i }>
						<span className="original-rinker-class">{ key }:</span>
						<span className="abc-rinker-class">{ value }</span>
					</div>
				)
			) }
		</div>
	);
};
