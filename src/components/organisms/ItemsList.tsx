import { __ } from '@wordpress/i18n';

import { addPrefix } from '../../utils/constant';
import { Toggle } from '../atoms/Toggle';
import { CssEditor } from './CssEditor';
import { Items } from './Items';

export const ItemList = () => {
	return (
		<>
			<Items
				title={ __( 'Use Rinker measures', 'ad-block-counter' ) }
				classValue="use-rinker"
			>
				<Toggle
					itemKey={ `${ addPrefix( 'rinker' ) }` as 'abc_rinker' }
					label={ __(
						'Disable ad blocking for Rinker',
						'ad-block-counter'
					) }
				/>
			</Items>
			<Items
				title={ __( 'Logged in user settings', 'ad-block-counter' ) }
				classValue={ 'logged-in-user' }
			>
				<Toggle
					itemKey={
						`${ addPrefix(
							'logged_in_user'
						) }` as 'abc_logged_in_user'
					}
					label={ __(
						"Don't apply the setting to WordPress logged in users.",
						'ad-block-counter'
					) }
				/>
			</Items>
			<CssEditor />
		</>
	);
};
