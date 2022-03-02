import { css } from '@codemirror/lang-css';
import CodeMirror from '@uiw/react-codemirror';

import { CodeEditorPropsType } from '../../types/ComponentsType';

export const CodeEditor = ( props: CodeEditorPropsType ) => {
	const { editorValue, setEditorValue } = props;

	return (
		<CodeMirror
			value={ editorValue }
			width="80%"
			height="400px"
			min-width="50%"
			min-height="400px"
			max-height="500px"
			theme="light"
			extensions={ [ css() ] }
			onChange={ ( value ) => setEditorValue( value ) }
		/>
	);
};
