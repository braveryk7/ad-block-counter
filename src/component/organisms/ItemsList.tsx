import { __ } from '@wordpress/i18n';

import { ShowRinkerClasses } from '../molecules/ShowRinkerClasses';
import { Toggle } from '../molecules/Toggle';
import { CssEditor } from './CssEditor';
import { Items } from './Items';

export const ItemList = () => {
	return (
		<>
			<Items
				title={ __( 'Use Rinker', 'ad-block-counter' ) }
				classValue="use-rinker"
			>
				<Toggle
					itemKey="abc_rinker"
					label={ __( 'Use Rinker', 'ad-block-counter' ) }
				/>
			</Items>
			<Items
				title={ __( 'ログインユーザー設定', 'ad-block-counter' ) }
				classValue={ 'logged-in-user' }
			>
				<Toggle
					itemKey="abc_logged_in_user"
					label={ __(
						'WordPressログイン中のユーザーに限り設定を適用させない',
						'ad-block-counter'
					) }
				/>
			</Items>
			<CssEditor />
			<Items
				title={ __( 'Rinker classes', 'ad-block-counter' ) }
				classValue="rinker-classes"
			>
				<ShowRinkerClasses />
			</Items>
		</>
	);
};
