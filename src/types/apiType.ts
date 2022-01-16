export type apiType = {
	abc_rinker?: boolean; // eslint-disable-line
	abc_rinker_classes?: {}; // eslint-disable-line
};

export type WPApiType< T > = {
	[ key: string ]: { // eslint-disable-line
		[ key: string ]: T;
	};
};
