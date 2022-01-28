import { __ } from '@wordpress/i18n';

export const ActivateRinker = () => {
	return (
		<div className="abc-item-wrapper">
			<h2>
				{ __(
					'このプラグインはRinkerを有効化する必要があります',
					'ad-block-counter'
				) }
			</h2>
			<p>
				{ __( '現在のRinkerの状態', 'ad-block-counter' ) }:{ ' ' }
				{ __( '無効', 'ad-block-counter' ) }
			</p>
			<p>
				{ __(
					'インストール済みプラグインページでRinkerを有効化してください。',
					'ad-block-counter'
				) }
			</p>
		</div>
	);
};
