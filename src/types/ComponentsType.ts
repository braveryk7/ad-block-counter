export type TogglePropsType = {
	itemKey: 'abc_rinker' | 'abc_logged_in_user';
	label: string;
};

export type CssEditorPropsType = {
	itemKey?: string;
	editorValue: string;
	setEditorValue?: React.Dispatch< React.SetStateAction< string > >;
};
