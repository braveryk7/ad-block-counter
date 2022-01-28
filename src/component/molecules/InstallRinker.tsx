import { __ } from '@wordpress/i18n';

export const InstallRinker = () => {
	return (
		<div className="abc-item-wrapper">
			<h2>
				{ __(
					'このプラグインはRinkerをインストールする必要があります',
					'ad-block-counter'
				) }
			</h2>
			<p>
				{ __( '現在のRinkerの状態', 'ad-block-counter' ) }:{ ' ' }
				{ __( '未インストール', 'ad-block-counter' ) }
			</p>
			<p>
				<a
					href="https://oyakosodate.com/rinker/"
					target="_blank"
					rel="noreferrer"
				>
					{ __( 'Rinker公式サイト', 'ad-block-counter' ) }
				</a>
				{ __(
					'でRinkerをダウンロード/インストールしてください。',
					'ad-block-counter'
				) }
			</p>
			<p>
				{ __(
					'Rinkerは完全無料で利用できる、商品リンク管理プラグインです。',
					'ad-block-counter'
				) }
			</p>
		</div>
	);
};
