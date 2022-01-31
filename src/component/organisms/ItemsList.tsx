import { __ } from '@wordpress/i18n';

import { Toggle } from '../molecules/Toggle';
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
					itemKey="abc_rinker"
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
					itemKey="abc_logged_in_user"
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
