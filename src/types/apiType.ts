export type apiType = {
	abc_use_rinker: boolean;
	abc_rinker_classes: object;
	abc_add_css: string;
	abc_logged_in_user: boolean;
	abc_rinker_status: number;
};

export type WPApiType< T > = {
	[ key: string ]: { // eslint-disable-line
		[ key: string ]: T;
	};
};
