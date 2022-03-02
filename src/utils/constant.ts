import { apiType } from 'types/apiType';

export const PREFIX = 'abc';

export const addPrefix = ( value: string ): string => {
	return PREFIX + '_' + value;
};

export const getApiInitValue = () => {
	const abcOptions: apiType = {
		abc_use_rinker: false,
		abc_rinker_classes: {},
		abc_add_css: '',
		abc_logged_in_user: false,
		abc_rinker_status: 0,
	};

	return abcOptions;
};
