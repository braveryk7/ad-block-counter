import { useContext, useState } from '@wordpress/element';
import { __ } from '@wordpress/i18n';

import { apiContext } from '../..';
import { addPrefix, PREFIX } from '../../utils/constant';
import { CodeEditor } from '../atoms/CodeEditor';
import { SaveButton } from '../atoms/SaveButton';

export const CssEditor = () => {
	const { apiData } = useContext( apiContext );
	const [ editorValue, setEditorValue ] = useState< string >(
		apiData.abc_add_css!
	);

	return (
		<div className={ `${ PREFIX }-item-wrapper ${ PREFIX }-css-editor` }>
			<h2>{ __( 'Edit CSS for Rinker', 'ad-block-counter' ) }</h2>
			<CodeEditor
				editorValue={ editorValue }
				setEditorValue={ setEditorValue }
			/>
			<SaveButton
				itemKey={ `${ addPrefix( 'add_css' ) }` }
				editorValue={ editorValue }
			/>
		</div>
	);
};
