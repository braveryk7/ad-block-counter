export type ItemsPropsType = {
	classValue: string;
	title: string;
	children: JSX.Element;
};

export type CssEditorPropsType = {
	itemKey?: string;
	editorValue: string;
	setEditorValue?: React.Dispatch< React.SetStateAction< string > >;
};
