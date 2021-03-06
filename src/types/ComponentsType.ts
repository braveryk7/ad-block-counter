export type TogglePropsType = {
	itemKey: 'abc_use_rinker' | 'abc_logged_in_user';
	label: string;
};

export type CodeEditorPropsType = {
	itemKey: string;
	editorValue: string;
	setEditorValue: React.Dispatch< React.SetStateAction< string > >;
};

export type SaveButtonType = Omit<CodeEditorPropsType, 'setEditorValue'>;
