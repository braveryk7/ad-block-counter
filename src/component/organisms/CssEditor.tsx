import { useContext, useState } from '@wordpress/element';
import { __ } from '@wordpress/i18n';

import { apiContext } from '../..';
import { CodeEditor } from '../molecules/CodeEditor';
import { SaveButton } from '../molecules/SaveButton';

export const CssEditor = () => {
	const { apiData } = useContext( apiContext );
	const [ editorValue, setEditorValue ] = useState< string >(
		apiData.abc_add_css!
	);

	return (
		<div className="abc-item-wrapper abc-css-editor">
			<h2>{ __( 'Edit CSS for Rinker', 'ad-block-counter' ) }</h2>
			<CodeEditor
				editorValue={ editorValue }
				setEditorValue={ setEditorValue }
			/>
			<SaveButton itemKey="abc_add_css" editorValue={ editorValue } />
		</div>
	);
};
