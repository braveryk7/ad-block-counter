import { Button } from '@wordpress/components';
import { useContext } from '@wordpress/element';
import { __ } from '@wordpress/i18n';

import { apiContext } from '../..';
import { useSetApi } from '../../hooks/useSetApi';
import { CssEditorPropsType } from '../../types/ComponentsType';
import { apiType } from '../../types/apiType';

export const SaveButton = ( props: CssEditorPropsType ) => {
	const { apiData, setApiData } = useContext( apiContext );
	const { itemKey, editorValue } = props;

	const saveValue = () => {
		const newItem: apiType = JSON.parse( JSON.stringify( { ...apiData } ) );

		newItem.abc_add_css = editorValue;
		setApiData( newItem );
	};

	useSetApi( itemKey!, apiData.abc_add_css! );
	return (
		<Button
			className="css-editor-button"
			isPrimary={ true }
			onClick={ () => {
				saveValue();
			} }
		>
			{ __( 'Save CSS', 'ad-block-counter' ) }
		</Button>
	);
};
