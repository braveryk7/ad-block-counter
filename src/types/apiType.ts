export type apiType = {
	abc_use_rinker?: boolean; // eslint-disable-line
	abc_rinker_classes?: {}; // eslint-disable-line
	abc_add_css?: string; // eslint-disable-line
	abc_logged_in_user?: boolean; // eslint-disable-line
	abc_rinker_status?: number; // eslint-disable-line
};

export type WPApiType< T > = {
	[ key: string ]: { // eslint-disable-line
		[ key: string ]: T;
	};
};
